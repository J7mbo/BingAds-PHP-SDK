<?php
// Generated on 6/7/2017 5:53:07 AM

namespace Microsoft\BingAds\V9\CustomerBilling;

{
    /**
     * Defines the possible status values of an InsertionOrder.
     * @link http://msdn.microsoft.com/en-us/library/dn743761(v=msads.90).aspx InsertionOrderStatus Value Set
     * 
     * @used-by InsertionOrder
     */
    final class InsertionOrderStatus
    {
        /** This value is deprecated. */
        const PendingSystemReview = 'PendingSystemReview';

        /** You need to approve or decline an order that Bing Ads created for your account. */
        const PendingUserReview = 'PendingUserReview';

        /** You have an approved insertion order, and your ads are eligible to run. */
        const Active = 'Active';

        /** You have declined an order created by Bing Ads, or the order you created has been declined. */
        const Declined = 'Declined';

        /** Your order has reached its end date and is no longer valid. */
        const Expired = 'Expired';

        /** You have canceled an order that you created or that was created by Bing Ads. */
        const Canceled = 'Canceled';
    }

}
