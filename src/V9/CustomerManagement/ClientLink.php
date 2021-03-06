<?php
// Generated on 6/7/2017 5:53:03 AM

namespace Microsoft\BingAds\V9\CustomerManagement;

{
    /**
     * Defines a client link object.
     * @link http://msdn.microsoft.com/en-us/library/dn632189(v=msads.90).aspx ClientLink Data Object
     * 
     * @uses ClientLinkStatus
     * @uses KeyValuePairOfstringstring
     * @used-by AddClientLinksRequest
     * @used-by SearchClientLinksResponse
     * @used-by UpdateClientLinksRequest
     */
    final class ClientLink
    {
        public $ClientAccountId;
        public $ClientAccountNumber;
        public $ManagingCustomerId;
        public $ManagingCustomerNumber;
        public $Note;
        public $Name;
        public $InviterEmail;
        public $InviterName;
        public $InviterPhone;
        public $IsBillToClient;
        public $StartDate;
        public $Status;
        public $SuppressNotification;
        public $LastModifiedDateTime;
        public $LastModifiedByUserId;
        public $Timestamp;
        public $ForwardCompatibilityMap;
    }

}
