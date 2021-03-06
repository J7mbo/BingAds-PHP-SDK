<?php
// Generated on 6/7/2017 5:55:37 AM

namespace Microsoft\BingAds\V11\CampaignManagement;

{
    /**
     * Gets a temporary URL that you can use to download a file that contains the supported geographical location targeting codes.
     * @link http://msdn.microsoft.com/en-us/library/mt791775(v=msads.110).aspx GetGeoLocationsFileUrl Request Object
     * 
     * @used-by BingAdsCampaignManagementService::GetGeoLocationsFileUrl
     */
    final class GetGeoLocationsFileUrlRequest
    {
        /**
         * The version of the location file that you want to download.
         * @var string
         */
        public $Version;

        /**
         * The language and locale of the geographical location code descriptions.
         * @var string
         */
        public $LanguageLocale;
    }
}
