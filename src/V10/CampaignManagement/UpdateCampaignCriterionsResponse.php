<?php
// Generated on 6/7/2017 5:54:10 AM

namespace Microsoft\BingAds\V10\CampaignManagement;

{
    /**
     * Updates one or more campaign criterions.
     * @link http://msdn.microsoft.com/en-us/library/dn913121(v=msads.100).aspx UpdateCampaignCriterions Response Object
     * 
     * @uses BatchErrorCollection
     * @used-by BingAdsCampaignManagementService::UpdateCampaignCriterions
     */
    final class UpdateCampaignCriterionsResponse
    {
        /**
         * An array of BatchErrorCollection objects that contain details for any criterion that were not successfully updated.
         * @var BatchErrorCollection[]
         */
        public $NestedPartialErrors;
    }
}
