<?php
// Generated on 6/7/2017 5:53:07 AM

namespace Microsoft\BingAds\V9\CustomerBilling;

{
    /**
     * Gets a list of insertion orders for the specified account.
     * @link http://msdn.microsoft.com/en-us/library/dn451269(v=msads.90).aspx GetInsertionOrdersByAccount Request Object
     * 
     * @used-by BingAdsCustomerBillingService::GetInsertionOrdersByAccount
     */
    final class GetInsertionOrdersByAccountRequest
    {
        /**
         * The identifier of the account that contains the insertion orders to get.
         * @var integer
         */
        public $AccountId;

        /**
         * A list of identifiers of the insertion orders to get.
         * @var integer[]
         */
        public $InsertionOrderIds;
    }
}
