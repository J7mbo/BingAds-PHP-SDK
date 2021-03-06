<?php
// Generated on 6/7/2017 5:55:37 AM

namespace Microsoft\BingAds\V11\CampaignManagement;

{
    /**
     * Retrieves the specified audiences from the specified account.
     * @link http://msdn.microsoft.com/en-us/library/mt807654(v=msads.110).aspx GetAudiencesByIds Request Object
     * 
     * @uses AudienceType
     * @used-by BingAdsCampaignManagementService::GetAudiencesByIds
     */
    final class GetAudiencesByIdsRequest
    {
        public $AudienceIds;
        public $Type;
    }
}
