<?php
// Generated on 6/7/2017 5:55:29 AM

namespace Microsoft\BingAds\V11\CustomerBilling;

{
    /**
     * Searches for insertion orders that match a specified criteria.
     * @link http://msdn.microsoft.com/en-us/library/dn743759(v=msads.110).aspx SearchInsertionOrders Request Object
     * 
     * @uses Predicate
     * @uses OrderBy
     * @uses Paging
     * @used-by BingAdsCustomerBillingService::SearchInsertionOrders
     */
    final class SearchInsertionOrdersRequest
    {
        /**
         * Determines the request conditions.
         * @var Predicate[]
         */
        public $Predicates;

        /**
         * Determines the order of results by the specified property of an account.
         * @var OrderBy[]
         */
        public $Ordering;

        /**
         * Determines the index and size of results per page.
         * @var Paging
         */
        public $PageInfo;
    }
}
