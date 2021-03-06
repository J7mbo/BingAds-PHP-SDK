<?php
// Generated on 6/7/2017 5:55:37 AM

namespace Microsoft\BingAds\V11\CampaignManagement;

{
    /**
     * Defines an ad extension that includes between 3 and 8 price table rows.
     * @link http://msdn.microsoft.com/en-us/library/mt807737(v=msads.110).aspx PriceAdExtension Data Object
     * 
     * @uses PriceExtensionType
     * @uses PriceTableRow
     * @uses CustomParameters
     */
    final class PriceAdExtension extends AdExtension
    {
        public $Language;
        public $PriceExtensionType;
        public $TableRows;
        public $TrackingUrlTemplate;
        public $UrlCustomParameters;
    }

}
