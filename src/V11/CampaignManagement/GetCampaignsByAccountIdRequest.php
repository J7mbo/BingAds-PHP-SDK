<?php
// Generated on 6/7/2017 5:55:37 AM

namespace Microsoft\BingAds\V11\CampaignManagement;

{
    /**
     * Gets the campaigns within an account.
     * @link http://msdn.microsoft.com/en-us/library/dn236299(v=msads.110).aspx GetCampaignsByAccountId Request Object
     * 
     * @uses CampaignType
     * @used-by BingAdsCampaignManagementService::GetCampaignsByAccountId
     */
    final class GetCampaignsByAccountIdRequest
    {
        /**
         * The identifier of the account that contains the campaigns to get.
         * @var integer
         */
        public $AccountId;

        /**
         * The type of campaign to get, for example SearchAndContent, Shopping, or DynamicSearchAds.
         * @var CampaignType
         */
        public $CampaignType;
    }
}
