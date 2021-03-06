<?php
// Generated on 6/7/2017 5:55:31 AM

namespace Microsoft\BingAds\V11\AdInsight;

{
    /**
     * The device search parameter filter that you can include when requesting keyword ideas.
     * @link http://msdn.microsoft.com/en-us/library/mt784409(v=msads.110).aspx DeviceSearchParameter Data Object
     * 
     * @uses DeviceCriterion
     */
    final class DeviceSearchParameter extends SearchParameter
    {
        /**
         * The device criterion for the returned keyword ideas.
         * @var DeviceCriterion
         */
        public $Device;
    }

}
