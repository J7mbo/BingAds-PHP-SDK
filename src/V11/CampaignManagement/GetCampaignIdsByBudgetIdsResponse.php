<?php
// Generated on 6/7/2017 5:55:37 AM

namespace Microsoft\BingAds\V11\CampaignManagement;

{
    /**
     * Gets the campaign identifiers that share each specified budget.
     * @link http://msdn.microsoft.com/en-us/library/mt750549(v=msads.110).aspx GetCampaignIdsByBudgetIds Response Object
     * 
     * @uses IdCollection
     * @uses BatchError
     * @used-by BingAdsCampaignManagementService::GetCampaignIdsByBudgetIds
     */
    final class GetCampaignIdsByBudgetIdsResponse
    {
        /**
         * The list of campaign id collections that corresponds directly to the budget identifiers that you specified in the request.
         * @var IdCollection[]
         */
        public $CampaignIdCollection;

        /**
         * An array of BatchError objects that contain details for any request items that were not successful.
         * @var BatchError[]
         */
        public $PartialErrors;
    }
}
