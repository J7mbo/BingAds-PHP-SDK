<?php

namespace Microsoft\BingAds\Samples\v11;

// For more information about installing and using the Bing Ads PHP SDK, 
// see https://go.microsoft.com/fwlink/?linkid=838593.

require_once "/../vendor/autoload.php";

include "/../AuthHelper.php";
include "/AdInsightHelper.php";
include "/CampaignManagementHelper.php";
include "/CustomerManagementHelper.php";

use SoapVar;
use SoapFault;
use Exception;

//Specify the Microsoft\BingAds\v11\CampaignManagement classes that will be used.
use Microsoft\BingAds\v11\CampaignManagement\Campaign;
use Microsoft\BingAds\v11\CampaignManagement\AdGroup;
use Microsoft\BingAds\v11\CampaignManagement\BiddableAdGroupCriterion;
use Microsoft\BingAds\v11\CampaignManagement\NegativeAdGroupCriterion;
use Microsoft\BingAds\v11\CampaignManagement\DeviceCriterion;
use Microsoft\BingAds\v11\CampaignManagement\BidMultiplier;
use Microsoft\BingAds\v11\CampaignManagement\AdGroupCriterion;
use Microsoft\BingAds\v11\CampaignManagement\AdGroupCriterionType;
use Microsoft\BingAds\v11\CampaignManagement\AdGroupCriterionStatus;
use Microsoft\BingAds\v11\CampaignManagement\NegativeCampaignCriterion;
use Microsoft\BingAds\v11\CampaignManagement\CampaignCriterion;
use Microsoft\BingAds\v11\CampaignManagement\CampaignCriterionType;
use Microsoft\BingAds\v11\CampaignManagement\CampaignCriterionStatus;
use Microsoft\BingAds\v11\CampaignManagement\BudgetLimitType;
use Microsoft\BingAds\v11\CampaignManagement\AdDistribution;
use Microsoft\BingAds\v11\CampaignManagement\Bid;
use Microsoft\BingAds\v11\CampaignManagement\Date;
use Microsoft\BingAds\v11\CampaignManagement\DynamicSearchAd;
use Microsoft\BingAds\v11\CampaignManagement\DynamicSearchAdsSetting;
use Microsoft\BingAds\v11\CampaignManagement\WebpageConditionOperand;
use Microsoft\BingAds\v11\CampaignManagement\WebpageCondition;
use Microsoft\BingAds\v11\CampaignManagement\WebpageParameter;
use Microsoft\BingAds\v11\CampaignManagement\Webpage;
use Microsoft\BingAds\v11\CampaignManagement\FixedBid;
use Microsoft\BingAds\v11\CampaignManagement\CustomParameter;
use Microsoft\BingAds\v11\CampaignManagement\CustomParameters;
use Microsoft\BingAds\v11\CampaignManagement\CampaignType;
use Microsoft\BingAds\v11\CampaignManagement\BatchErrorCollection;

// Specify the Microsoft\BingAds\Auth classes that will be used.
use Microsoft\BingAds\Auth\ServiceClient;
use Microsoft\BingAds\Auth\ServiceClientType;

// Specify the Microsoft\BingAds\Samples classes that will be used.
use Microsoft\BingAds\Samples\AuthHelper;
use Microsoft\BingAds\Samples\v11\AdInsightHelper;
use Microsoft\BingAds\Samples\v11\CampaignManagementHelper;
use Microsoft\BingAds\Samples\v11\CustomerManagementHelper;

$GLOBALS['AuthorizationData'] = null;
$GLOBALS['Proxy'] = null;
$GLOBALS['CustomerProxy'] = null; 
$GLOBALS['CampaignProxy'] = null; 

// Disable WSDL caching.

ini_set("soap.wsdl_cache_enabled", "0");
ini_set("soap.wsdl_cache_ttl", "0");

const DomainName = "booking.com";
const Language = "EN";

try
{
    // You should authenticate for Bing Ads production services with a Microsoft Account, 
    // instead of providing the Bing Ads username and password set. 
    
    //AuthHelper::AuthenticateWithOAuth();

    // However, authentication with a Microsoft Account is currently not supported in Sandbox,
    // so it is recommended that you set the UserName and Password in sandbox for testing.

    AuthHelper::AuthenticateWithUserName();

    $GLOBALS['CustomerProxy'] = new ServiceClient(ServiceClientType::CustomerManagementVersion11, $GLOBALS['AuthorizationData'], AuthHelper::GetApiEnvironment());

    // Set the GetUser request parameter to an empty user identifier to get the current 
    // authenticated Bing Ads user, and then search for all accounts the user may access.

    $user = CustomerManagementHelper::GetUser(null)->User;

    // For this example we'll use the first account.

    $accounts = CustomerManagementHelper::SearchAccountsByUserId($user->Id)->Accounts;
    $GLOBALS['AuthorizationData']->AccountId = $accounts->Account[0]->Id;
    $GLOBALS['AuthorizationData']->CustomerId = $accounts->Account[0]->ParentCustomerId;

    $GLOBALS['AdInsightProxy'] = new ServiceClient(ServiceClientType::AdInsightVersion11, $GLOBALS['AuthorizationData'], AuthHelper::GetApiEnvironment());
    $GLOBALS['CampaignProxy'] = new ServiceClient(ServiceClientType::CampaignManagementVersion11, $GLOBALS['AuthorizationData'], AuthHelper::GetApiEnvironment());

    // To get started with dynamic search ads, first you'll need to add a new Campaign 
    // with its type set to DynamicSearchAds. When you create the campaign, you'll need to 
    // include a DynamicSearchAdsSetting that specifies the target website domain and language.
    
    $settings = array();
    $dynamicSearchSetting = new DynamicSearchAdsSetting();
    $dynamicSearchSetting->DomainName = "contoso.com";
    $dynamicSearchSetting->Language = "English";
    $encodedSetting = new SoapVar($dynamicSearchSetting, SOAP_ENC_OBJECT, 'DynamicSearchAdsSetting', $GLOBALS['CampaignProxy']->GetNamespace());
    $settings[] = $encodedSetting;

    $campaigns = array();
    $campaign = new Campaign();
    $campaign->Name = "Women's Shoes " . $_SERVER['REQUEST_TIME'];
    $campaign->Description = "Red shoes line.";
    $campaign->BudgetType = BudgetLimitType::DailyBudgetStandard;
    $campaign->DailyBudget = 50.00;
    $campaign->Settings = $settings;
    $campaign->CampaignType = CampaignType::DynamicSearchAds;
    $campaign->TimeZone = "PacificTimeUSCanadaTijuana";
    $campaigns[] = $campaign;

    print "AddCampaigns\n";
    $addCampaignsResponse = CampaignManagementHelper::AddCampaigns($GLOBALS['AuthorizationData']->AccountId, $campaigns);
    $nillableCampaignIds = $addCampaignsResponse->CampaignIds->long;
    CampaignManagementHelper::OutputIds($nillableCampaignIds);
    if(isset($addCampaignsResponse->PartialErrors->BatchError)){
        CampaignManagementHelper::OutputPartialErrors($addCampaignsResponse->PartialErrors->BatchError);
    }
    
    // Next, create a new AdGroup within the dynamic search ads campaign. 

    $adGroups = array();

    date_default_timezone_set('UTC');
    $endDate = new Date();
    $endDate->Day = 31;
    $endDate->Month = 12;
    $endDate->Year = date("Y");

    $adGroup = new AdGroup();
    $adGroup->Name = "Women's Heated Ski Glove Sale";
    $adGroup->AdDistribution = AdDistribution::Search;
    $adGroup->StartDate = null;
    $adGroup->EndDate = $endDate;
    $adGroup->SearchBid = new Bid();
    $adGroup->SearchBid->Amount = 0.07;
    $adGroup->Language = "English";
    $adGroups[] = $adGroup;
 
    print "\nAddAdGroups\n";
    $addAdGroupsResponse = CampaignManagementHelper::AddAdGroups($nillableCampaignIds[0], $adGroups);
    $nillableAdGroupIds = $addAdGroupsResponse->AdGroupIds->long;
    CampaignManagementHelper::OutputIds($nillableAdGroupIds);
    if(isset($addAdGroupsResponse->PartialErrors->BatchError)){
        CampaignManagementHelper::OutputPartialErrors($addAdGroupsResponse->PartialErrors->BatchError);
    }

    // You can add one or more Webpage criterion to each ad group that helps determine 
    // whether or not to serve dynamic search ads.

    $adGroupCriterions = array();

    $adGroupWebpagePositivePageContent = new BiddableAdGroupCriterion();
    $adGroupWebpagePositivePageContent->Type = "BiddableAdGroupCriterion";
    $adGroupWebpagePositivePageContent->AdGroupId = $nillableAdGroupIds[0];

    $webpageConditionsAGWPPC = array();
	$conditionAGWPPC = new WebpageCondition();
	$conditionAGWPPC->Argument = "flowers";
	$conditionAGWPPC->Operand = WebpageConditionOperand::PageContent;
	$webpageConditionsAGWPPC[] = $conditionAGWPPC;
    $webpageParameterAGWPPC = new WebpageParameter();
    $webpageParameterAGWPPC->Conditions = $webpageConditionsAGWPPC;
    $webpageParameterAGWPPC->CriterionName = "Ad Group Webpage Positive Page Content Criterion";
                
    $criterionAGWPPC = new Webpage();
    $criterionAGWPPC->Type = "Webpage";
    $criterionAGWPPC->Parameter = $webpageParameterAGWPPC;
    $adGroupWebpagePositivePageContent->Criterion = new SoapVar($criterionAGWPPC, SOAP_ENC_OBJECT, 'Webpage', "http://schemas.datacontract.org/2004/07/Microsoft.AdCenter.Advertiser.CampaignManagement.Api.DataContracts.V11");
    
    $criterionBidAGWPPC = new FixedBid();
    $criterionBidAGWPPC->Amount = 0.50;
    $adGroupWebpagePositivePageContent->CriterionBid = new SoapVar($criterionBidAGWPPC, SOAP_ENC_OBJECT, 'FixedBid', $GLOBALS['CampaignProxy']->GetNamespace());

    // Set custom parameters that are specific to this webpage criterion, 
    // and can be used by the criterion, ad group, campaign, or account level tracking template. 
    // In this example we are using the campaign level tracking template.
    $adGroupWebpagePositivePageContent->UrlCustomParameters = new CustomParameters();
    $adGroupWebpagePositivePageContent->UrlCustomParameters->Parameters = array();
    $customParameter1AGWPPC = new CustomParameter();
    $customParameter1AGWPPC->Key = "promoCode";
    $customParameter1AGWPPC->Value = "PROMO1";
    $adGroupWebpagePositivePageContent->UrlCustomParameters->Parameters[] = $customParameter1AGWPPC;
    $customParameter2AGWPPC = new CustomParameter();
    $customParameter2AGWPPC->Key = "season";
    $customParameter2AGWPPC->Value = "summer";
    $adGroupWebpagePositivePageContent->UrlCustomParameters->Parameters[] = $customParameter2AGWPPC;

    // DestinationUrl and FinalUrls are not supported with Webpage criterion. 
    // The Final URL is dynamically created at the ad level.
    $adGroupWebpagePositivePageContent->DestinationUrl = null;
    $adGroupWebpagePositivePageContent->FinalUrls = null;

    // You could use a tracking template which would override the campaign level
    // tracking template. Tracking templates defined for lower level entities 
    // override those set for higher level entities.
    // In this example we are using the campaign level tracking template.
    $adGroupWebpagePositivePageContent->TrackingUrlTemplate = null;
    
    $adGroupCriterions[] = new SoapVar($adGroupWebpagePositivePageContent, SOAP_ENC_OBJECT, 'BiddableAdGroupCriterion', $GLOBALS['CampaignProxy']->GetNamespace());


    // To discover the categories that you can use for Webpage criterion (positive or negative), 
    // use the GetDomainCategories operation with the Ad Insight service.
    
    $getDomainCategoriesResponse = AdInsightHelper::GetDomainCategories(DomainName, Language);
    $categories = $getDomainCategoriesResponse->Categories;

    // If any categories are available let's use one as a condition.
    if (!empty($categories) && count((array)$categories) > 0)
    {
        $adGroupWebpagePositiveCategory = new BiddableAdGroupCriterion();
        $adGroupWebpagePositiveCategory->Type = "BiddableAdGroupCriterion";
        $adGroupWebpagePositiveCategory->AdGroupId = $nillableAdGroupIds[0];

        $webpageConditionsAGWPC = array();
        $conditionAGWPC = new WebpageCondition();
        $conditionAGWPC->Argument = $categories->DomainCategory[0]->CategoryName;
        $conditionAGWPC->Operand = WebpageConditionOperand::Category;
        $webpageConditionsAGWPC[] = $conditionAGWPC;
        $webpageParameterAGWPC = new WebpageParameter();
        $webpageParameterAGWPC->Conditions = $webpageConditionsAGWPC;
        $webpageParameterAGWPC->CriterionName = "Ad Group Webpage Positive Category Criterion";
                    
        $criterionAGWPC = new Webpage();
        $criterionAGWPC->Type = "Webpage";
        $criterionAGWPC->Parameter = $webpageParameterAGWPC;
        $adGroupWebpagePositiveCategory->Criterion = new SoapVar($criterionAGWPC, SOAP_ENC_OBJECT, 'Webpage', "http://schemas.datacontract.org/2004/07/Microsoft.AdCenter.Advertiser.CampaignManagement.Api.DataContracts.V11");
    
        $criterionBidAGWPC = new FixedBid();
        $criterionBidAGWPC->Amount = 0.50;
        $adGroupWebpagePositiveCategory->CriterionBid = new SoapVar($criterionBidAGWPC, SOAP_ENC_OBJECT, 'FixedBid', $GLOBALS['CampaignProxy']->GetNamespace());
        
        $adGroupCriterions[] = new SoapVar($adGroupWebpagePositiveCategory, SOAP_ENC_OBJECT, 'BiddableAdGroupCriterion', $GLOBALS['CampaignProxy']->GetNamespace());
    }

    // If you want to exclude certain portions of your website, you can add negative Webpage 
    // criterion at the campaign and ad group level. 

    $adGroupWebpageNegativeUrl = new NegativeAdGroupCriterion();
    $adGroupWebpageNegativeUrl->Type = "NegativeAdGroupCriterion";
    $adGroupWebpageNegativeUrl->AdGroupId = $nillableAdGroupIds[0];

    $webpageConditionsAGWNU = array();
    $conditionAGWNU = new WebpageCondition();
    $conditionAGWNU->Argument = DomainName;
    $conditionAGWNU->Operand = WebpageConditionOperand::Url;
    $webpageConditionsAGWNU[] = $conditionAGWNU;
    $webpageParameterAGWNU = new WebpageParameter();
    $webpageParameterAGWNU->Conditions = $webpageConditionsAGWNU;
    // If you do not specify any name, then it will be set to a concatenated list of conditions. 
    $webpageParameterAGWNU->CriterionName = null;
                
    $criterionAGWNU = new Webpage();
    $criterionAGWNU->Type = "Webpage";
    $criterionAGWNU->Parameter = $webpageParameterAGWNU;
    $adGroupWebpageNegativeUrl->Criterion = new SoapVar($criterionAGWNU, SOAP_ENC_OBJECT, 'Webpage', "http://schemas.datacontract.org/2004/07/Microsoft.AdCenter.Advertiser.CampaignManagement.Api.DataContracts.V11");
    
    $adGroupCriterions[] = new SoapVar($adGroupWebpageNegativeUrl, SOAP_ENC_OBJECT, 'BiddableAdGroupCriterion', $GLOBALS['CampaignProxy']->GetNamespace());

    print("\nAdding Ad Group Webpage Criterion . . . \n\n");
    CampaignManagementHelper::OutputAdGroupCriterions($adGroupCriterions);
    $addAdGroupCriterionsResponse = CampaignManagementHelper::AddAdGroupCriterions($adGroupCriterions, AdGroupCriterionType::Webpage);
    $adGroupWebpagePositivePageContentIds = $addAdGroupCriterionsResponse->AdGroupCriterionIds->long;
    print("\nNew Ad Group Criterion Ids:\n");
    CampaignManagementHelper::OutputIds($adGroupWebpagePositivePageContentIds);
    $adGroupWebpagePositivePageContentErrors =
        $addAdGroupCriterionsResponse->NestedPartialErrors;
    print("\nAddAdGroupCriterions Errors:\n");
    if(isset($adGroupWebpagePositivePageContentErrors->BatchErrorCollection))
    {
        CampaignManagementHelper::OutputBatchErrorCollections($adGroupWebpagePositivePageContentErrors->BatchErrorCollection);
    }

    // The negative Webpage criterion at the campaign level applies to all ad groups 
    // within the campaign; however, if you define ad group level negative Webpage criterion, 
    // the campaign criterion is ignored for that ad group.

    $campaignCriterions = array();

    $campaignWebpageNegativeUrl = new NegativeCampaignCriterion();
    $campaignWebpageNegativeUrl->Type = "NegativeCampaignCriterion";
    $campaignWebpageNegativeUrl->CampaignId = $nillableCampaignIds[0];

    $webpageConditionsCWNU = array();
    $conditionCWNU = new WebpageCondition();
    $conditionCWNU->Argument = DomainName . "\\seattle";
    $conditionCWNU->Operand = WebpageConditionOperand::Url;
    $webpageConditionsCWNU[] = $conditionCWNU;
    $webpageParameterCWNU = new WebpageParameter();
    $webpageParameterCWNU->Conditions = $webpageConditionsCWNU;
    $webpageParameterCWNU->CriterionName = "Campaign Negative Webpage Url Criterion";
                
    $criterionCWNU = new Webpage();
    $criterionCWNU->Type = "Webpage";
    $criterionCWNU->Parameter = $webpageParameterCWNU;
    $campaignWebpageNegativeUrl->Criterion = new SoapVar($criterionCWNU, SOAP_ENC_OBJECT, 'Webpage', "http://schemas.datacontract.org/2004/07/Microsoft.AdCenter.Advertiser.CampaignManagement.Api.DataContracts.V11");

    $campaignCriterions[] = new SoapVar($campaignWebpageNegativeUrl, SOAP_ENC_OBJECT, 'NegativeCampaignCriterion', $GLOBALS['CampaignProxy']->GetNamespace());

    print("\nAdding Campaign Webpage Criterion . . . \n");
    CampaignManagementHelper::OutputCampaignCriterions($campaignCriterions);
    $addCampaignCriterionsResponse = CampaignManagementHelper::AddCampaignCriterions($campaignCriterions, CampaignCriterionType::Webpage);
    $campaignCriterionIds = $addCampaignCriterionsResponse->CampaignCriterionIds->long;
    print("\nNew Campaign Criterion Ids:\n");
    CampaignManagementHelper::OutputIds($campaignCriterionIds);
    $campaignCriterionErrors = $addCampaignCriterionsResponse->NestedPartialErrors;
    print("\nAddCampaignCriterions Errors:\n");
    if(isset($campaignCriterionErrors->BatchErrorCollection))
    {
        CampaignManagementHelper::OutputBatchErrorCollections($campaignCriterionErrors->BatchErrorCollection);
    }


    // Finally you can add a DynamicSearchAd into the ad group. The ad title and display URL 
    // are generated automatically based on the website domain and language that you want to target.

    $ads = array();
    $ad = new DynamicSearchAd();
    $ad->Text = "Find New Customers & Increase Sales! Start Advertising on Contoso Today.";
    $ad->Path1 = "seattle";
    $ad->Path2 = "shoe sale";
    // You cannot set FinalUrls. The Final URL will be a dynamically selected landing page.
    // The final URL is distinct from the path that customers will see and click on in your ad.
    $ad->FinalUrls = null;
    // You could use a tracking template which would override the campaign level
    // tracking template. Tracking templates defined for lower level entities 
    // override those set for higher level entities.
    // In this example we are using the campaign level tracking template.
    $ad->TrackingUrlTemplate = null;
    // Set custom parameters that are specific to this ad, 
    // and can be used by the ad, webpage, ad group, campaign, or account level tracking template. 
    // In this example we are using the campaign level tracking template.
    $ad->UrlCustomParameters = new CustomParameters();
    $ad->UrlCustomParameters->Parameters = array();
    $customParameter1DSA = new CustomParameter();
    $customParameter1DSA->Key = "promoCode";
    $customParameter1DSA->Value = "PROMO1";
    $ad->UrlCustomParameters->Parameters[] = $customParameter1DSA;
    $customParameter2DSA = new CustomParameter();
    $customParameter2DSA->Key = "season";
    $customParameter2DSA->Value = "summer";
    $ad->UrlCustomParameters->Parameters[] = $customParameter2DSA;
    $encodedAd = new SoapVar($ad, SOAP_ENC_OBJECT, 'DynamicSearchAd', $GLOBALS['CampaignProxy']->GetNamespace());
    $ads[] = $encodedAd;
    
	print "\nAddAds\n";
    $addAdsResponse = CampaignManagementHelper::AddAds($nillableAdGroupIds[0], $ads);
    $nillableAdIds = $addAdsResponse->AdIds->long;
    CampaignManagementHelper::OutputIds($nillableAdIds);
    if(isset($addAdsResponse->PartialErrors->BatchError)){
        CampaignManagementHelper::OutputPartialErrors($addAdsResponse->PartialErrors->BatchError);
    }

    // Retrieve the Webpage criterion for the campaign.
    $getCampaignCriterionsByIdsResponse = CampaignManagementHelper::GetCampaignCriterionsByIds(
        $nillableCampaignIds[0],
        null,
        CampaignCriterionType::Webpage
    );

    print "\nRetrieving the Campaign Webpage Criterions that we added . . . \n";
    $campaignCriterions = $getCampaignCriterionsByIdsResponse->CampaignCriterions;
    CampaignManagementHelper::OutputCampaignCriterions($campaignCriterions->CampaignCriterion);

    // Retrieve the Webpage criterion for the ad group and then test some update scenarios.
    $getAdGroupCriterionsByIdsResponse = CampaignManagementHelper::GetAdGroupCriterionsByIds(
        $nillableAdGroupIds[0],
        null,
        AdGroupCriterionType::Webpage
    );

    print "\nRetrieving the Ad Group Webpage Criterions that we added . . . \n";
    $adGroupCriterions = $getAdGroupCriterionsByIdsResponse->AdGroupCriterions;
    CampaignManagementHelper::OutputAdGroupCriterions($adGroupCriterions->AdGroupCriterion);
    

    $updateAdGroupCriterions = array();

    foreach ($adGroupCriterions->AdGroupCriterion as $adGroupCriterion)
    {
        if ($adGroupCriterion->Type === "BiddableAdGroupCriterion")
        {
            // You can update the criterion name for BiddableAdGroupCriterion and NegativeAdGroupCriterion
    
            $criterionUpdateAttemptSuccess = new Webpage();
            $criterionUpdateAttemptSuccess->Type = "Webpage";
            $webpageParameterUpdateAttemptSuccess = new WebpageParameter();
            $webpageParameterUpdateAttemptSuccess->CriterionName = "Update Attempt Success";
            $criterionUpdateAttemptSuccess->Parameter = $webpageParameterUpdateAttemptSuccess;

            // You can update the bid for BiddableAdGroupCriterion

            $criterionBidUpdateAttemptSuccess = new FixedBid();
            $criterionBidUpdateAttemptSuccess->Amount = 0.75;
    
            $biddableAdGroupCriterionUpdateAttemptSuccess = new BiddableAdGroupCriterion();
            $biddableAdGroupCriterionUpdateAttemptSuccess->Type = "BiddableAdGroupCriterion";
            $biddableAdGroupCriterionUpdateAttemptSuccess->AdGroupId = $adGroupCriterion->AdGroupId;
            $biddableAdGroupCriterionUpdateAttemptSuccess->Id = $adGroupCriterion->Id;
            $biddableAdGroupCriterionUpdateAttemptSuccess->Criterion = new SoapVar($criterionUpdateAttemptSuccess, SOAP_ENC_OBJECT, 'Webpage', "http://schemas.datacontract.org/2004/07/Microsoft.AdCenter.Advertiser.CampaignManagement.Api.DataContracts.V11");
            $biddableAdGroupCriterionUpdateAttemptSuccess->CriterionBid = new SoapVar($criterionBidUpdateAttemptSuccess, SOAP_ENC_OBJECT, 'FixedBid', $GLOBALS['CampaignProxy']->GetNamespace());

            $updateAdGroupCriterions[] = new SoapVar($biddableAdGroupCriterionUpdateAttemptSuccess, SOAP_ENC_OBJECT, 'BiddableAdGroupCriterion', $GLOBALS['CampaignProxy']->GetNamespace());
        }
        else if ($adGroupCriterion->Type === "NegativeAdGroupCriterion")
        {
            // You can update the Webpage criterion name but cannot update the conditions. 
            // To update the conditions you must delete the criterion and add a new criterion.
            // This update attempt will return an error.

            $criterionUpdateAttemptFailure = new Webpage();
            $criterionUpdateAttemptFailure->Type = "Webpage";
            $webpageParameterUpdateAttemptFailure = new WebpageParameter();
            $webpageParameterUpdateAttemptFailure->CriterionName = "Update Attempt Failure";
            $webpageConditionsUpdateAttemptFailure = array();
            $conditionUpdateAttemptFailure = new WebpageCondition();
            $conditionUpdateAttemptFailure->Argument = "Books";
            $conditionUpdateAttemptFailure->Operand = WebpageConditionOperand::PageContent;
            $webpageConditionsUpdateAttemptFailure[] = $conditionUpdateAttemptFailure;
            $webpageParameterUpdateAttemptFailure->Conditions = $webpageConditionsUpdateAttemptFailure;
            $criterionUpdateAttemptFailure->Parameter = $webpageParameterUpdateAttemptFailure;

            $negativeAdGroupCriterionUpdateAttemptFailure = new NegativeAdGroupCriterion();
            $negativeAdGroupCriterionUpdateAttemptFailure->Type = "NegativeAdGroupCriterion";
            $negativeAdGroupCriterionUpdateAttemptFailure->AdGroupId = $adGroupCriterion->AdGroupId;
            $negativeAdGroupCriterionUpdateAttemptFailure->Id = $adGroupCriterion->Id;
            $negativeAdGroupCriterionUpdateAttemptFailure->Criterion = new SoapVar($criterionUpdateAttemptFailure, SOAP_ENC_OBJECT, 'Webpage', "http://schemas.datacontract.org/2004/07/Microsoft.AdCenter.Advertiser.CampaignManagement.Api.DataContracts.V11");
            
            $updateAdGroupCriterions[] = new SoapVar($negativeAdGroupCriterionUpdateAttemptFailure, SOAP_ENC_OBJECT, 'NegativeAdGroupCriterion', $GLOBALS['CampaignProxy']->GetNamespace());
        }
    }                

    print "\nUpdating Ad Group Webpage Criterion . . . \n";
    CampaignManagementHelper::OutputAdGroupCriterions($updateAdGroupCriterions);
    $updateAdGroupCriterionsResponse = CampaignManagementHelper::UpdateAdGroupCriterions($updateAdGroupCriterions, AdGroupCriterionType::Webpage);
    $adGroupCriterionErrors = $updateAdGroupCriterionsResponse->NestedPartialErrors;
    print("\nUpdateAdGroupCriterions Errors:\n");
    if(isset($adGroupCriterionErrors->BatchErrorCollection))
    {
        CampaignManagementHelper::OutputBatchErrorCollections($adGroupCriterionErrors->BatchErrorCollection);
    }

    // Delete the campaign, ad group, criterions, and ad that were previously added. 
    // You should remove this operation if you want to view the added entities in the 
    // Bing Ads web application or another tool.

    CampaignManagementHelper::DeleteCampaigns($GLOBALS['AuthorizationData']->AccountId, array($nillableCampaignIds[0]));
    printf("\nDeleted CampaignId %d\n\n", $nillableCampaignIds[0]);
}
catch (SoapFault $e)
{
    // Output the last request/Response->
	
    print "\nLast SOAP request/response:\n";
    printf("Fault Code: %s\nFault String: %s\n", $e->faultcode, $e->faultstring);
    print $GLOBALS['Proxy']->GetWsdl() . "\n";
    print $GLOBALS['Proxy']->GetService()->__getLastRequest()."\n";
    print $GLOBALS['Proxy']->GetService()->__getLastResponse()."\n";
	
    // Campaign Management service operations can throw AdApiFaultDetail.
    if (isset($e->detail->AdApiFaultDetail))
    {
        // Log this fault.

        print "The operation failed with the following faults:\n";

        $errors = is_array($e->detail->AdApiFaultDetail->Errors->AdApiError)
        ? $e->detail->AdApiFaultDetail->Errors->AdApiError
        : array('AdApiError' => $e->detail->AdApiFaultDetail->Errors->AdApiError);

        // If the AdApiError array is not null, the following are examples of error codes that may be found.
        foreach ($errors as $error)
        {
            print "AdApiError\n";
            printf("Code: %d\nError Code: %s\nMessage: %s\n", $error->Code, $error->ErrorCode, $error->Message);

            switch ($error->Code)
            {
                case 105:  // InvalidCredentials
                    break;
                case 117:  // CallRateExceeded
                    break;
                default:
                    print "Please see MSDN documentation for more details about the error code output above.\n";
                    break;
            }
        }
    }

    // Campaign Management service operations can throw ApiFaultDetail.
    elseif (isset($e->detail->EditorialApiFaultDetail))
    {
        // Log this fault.

        print "The operation failed with the following faults:\n";

        // If the BatchError array is not null, the following are examples of error codes that may be found.
        if (!empty($e->detail->EditorialApiFaultDetail->BatchErrors))
        {
            $errors = is_array($e->detail->EditorialApiFaultDetail->BatchErrors->BatchError)
            ? $e->detail->EditorialApiFaultDetail->BatchErrors->BatchError
            : array('BatchError' => $e->detail->EditorialApiFaultDetail->BatchErrors->BatchError);

            foreach ($errors as $error)
            {
                printf("BatchError at Index: %d\n", $error->Index);
                printf("Code: %d\nError Code: %s\nMessage: %s\n", $error->Code, $error->ErrorCode, $error->Message);

                switch ($error->Code)
                {
                    default:
                        print "Please see MSDN documentation for more details about the error code output above.\n";
                        break;
                }
            }
        }

        // If the EditorialError array is not null, the following are examples of error codes that may be found.
        if (!empty($e->detail->EditorialApiFaultDetail->EditorialErrors))
        {
            $errors = is_array($e->detail->EditorialApiFaultDetail->EditorialErrors->EditorialError)
            ? $e->detail->EditorialApiFaultDetail->EditorialErrors->EditorialError
            : array('BatchError' => $e->detail->EditorialApiFaultDetail->EditorialErrors->EditorialError);

            foreach ($errors as $error)
            {
                printf("EditorialError at Index: %d\n", $error->Index);
                printf("Code: %d\nError Code: %s\nMessage: %s\n", $error->Code, $error->ErrorCode, $error->Message);
                printf("Appealable: %s\nDisapproved Text: %s\nCountry: %s\n", $error->Appealable, $error->DisapprovedText, $error->PublisherCountry);

                switch ($error->Code)
                {
                    default:
                        print "Please see MSDN documentation for more details about the error code output above.\n";
                        break;
                }
            }
        }

        // If the OperationError array is not null, the following are examples of error codes that may be found.
        if (!empty($e->detail->EditorialApiFaultDetail->OperationErrors))
        {
            $errors = is_array($e->detail->EditorialApiFaultDetail->OperationErrors->OperationError)
            ? $e->detail->EditorialApiFaultDetail->OperationErrors->OperationError
            : array('OperationError' => $e->detail->EditorialApiFaultDetail->OperationErrors->OperationError);

            foreach ($errors as $error)
            {
                print "OperationError\n";
                printf("Code: %d\nError Code: %s\nMessage: %s\n", $error->Code, $error->ErrorCode, $error->Message);

                switch ($error->Code)
                {
                    case 106:   // UserIsNotAuthorized
                        break;
                    case 1102:  // CampaignServiceInvalidAccountId
                        break;
                    default:
                        print "Please see MSDN documentation for more details about the error code output above.\n";
                        break;
                }
            }
        }
    }
}
catch (Exception $e)
{
    if ($e->getPrevious())
    {
        ; // Ignore fault exceptions that we already caught.
    }
    else
    {
        print $e->getCode()." ".$e->getMessage()."\n\n";
        print $e->getTraceAsString()."\n\n";
    }
}

?>
