<?php
// Generated on 6/7/2017 5:54:09 AM

namespace Microsoft\BingAds\V10\CampaignManagement;

{
    /**
     * Deletes the specified remarketing lists.
     * @link http://msdn.microsoft.com/en-us/library/mt790575(v=msads.100).aspx DeleteRemarketingLists Response Object
     * 
     * @uses BatchError
     * @used-by BingAdsCampaignManagementService::DeleteRemarketingLists
     */
    final class DeleteRemarketingListsResponse
    {
        /**
         * An array of BatchError objects that contain details for any request items that were not successful.
         * @var BatchError[]
         */
        public $PartialErrors;
    }
}
