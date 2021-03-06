<?php
// Generated on 6/7/2017 5:54:10 AM

namespace Microsoft\BingAds\V10\CampaignManagement;

{
    /**
     * Sets the negative site URLs of the specified campaigns.
     * @link http://msdn.microsoft.com/en-us/library/dn277504(v=msads.100).aspx SetNegativeSitesToCampaigns Request Object
     * 
     * @uses CampaignNegativeSites
     * @used-by BingAdsCampaignManagementService::SetNegativeSitesToCampaigns
     */
    final class SetNegativeSitesToCampaignsRequest
    {
        /**
         * The identifier of the account that contains the campaigns.
         * @var integer
         */
        public $AccountId;

        /**
         * An array of CampaignNegativeSites objects that identify the campaigns to update with the specified negative site URLs.
         * @var CampaignNegativeSites[]
         */
        public $CampaignNegativeSites;
    }
}
