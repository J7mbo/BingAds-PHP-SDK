<?php
// Generated on 6/7/2017 5:54:09 AM

namespace Microsoft\BingAds\V10\CampaignManagement;

{
    /**
     * Removes the target association for the specified campaign.
     * @link http://msdn.microsoft.com/en-us/library/dn277503(v=msads.100).aspx DeleteTargetFromCampaign Request Object
     * 
     * @used-by BingAdsCampaignManagementService::DeleteTargetFromCampaign
     */
    final class DeleteTargetFromCampaignRequest
    {
        /**
         * The identifier of the campaign from which to remove the target association.
         * @var integer
         */
        public $CampaignId;
    }
}
