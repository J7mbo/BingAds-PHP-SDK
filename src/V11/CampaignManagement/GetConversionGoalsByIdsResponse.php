<?php
// Generated on 6/7/2017 5:55:37 AM

namespace Microsoft\BingAds\V11\CampaignManagement;

{
    /**
     * Gets the specified conversion goals.
     * @link http://msdn.microsoft.com/en-us/library/mt759540(v=msads.110).aspx GetConversionGoalsByIds Response Object
     * 
     * @uses ConversionGoal
     * @uses BatchError
     * @used-by BingAdsCampaignManagementService::GetConversionGoalsByIds
     */
    final class GetConversionGoalsByIdsResponse
    {
        /**
         * An array of ConversionGoal objects that corresponds directly to the conversion goal identifiers that you specified in the request.
         * @var ConversionGoal[]
         */
        public $ConversionGoals;

        /**
         * An array of BatchError objects that contain details for any request items that were not successful.
         * @var BatchError[]
         */
        public $PartialErrors;
    }
}
