<?php
// Generated on 6/7/2017 5:55:25 AM

namespace Microsoft\BingAds\V11\CustomerManagement;

{
    /**
     * Sends an invitation for a Microsoft account user to manage one or more Bing Ads customer accounts.
     * @link http://msdn.microsoft.com/en-us/library/dn789440(v=msads.110).aspx SendUserInvitation Response Object
     * 
     * @used-by BingAdsCustomerManagementService::SendUserInvitation
     */
    final class SendUserInvitationResponse
    {
        /**
         * A system-generated identifier for the user invitation that was sent.
         * @var integer
         */
        public $UserInvitationId;
    }
}
