<?php
// Generated on 6/7/2017 5:55:37 AM

namespace Microsoft\BingAds\V11\CampaignManagement;

{
    /**
     * Gets the specified campaign criterions.
     * @link http://msdn.microsoft.com/en-us/library/dn913135(v=msads.110).aspx GetCampaignCriterionsByIds Request Object
     * 
     * @uses CampaignCriterionType
     * @used-by BingAdsCampaignManagementService::GetCampaignCriterionsByIds
     */
    final class GetCampaignCriterionsByIdsRequest
    {
        public $CampaignCriterionIds;
        public $CampaignId;
        public $CriterionType;
    }
}
