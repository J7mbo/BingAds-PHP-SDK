<?php
// Generated on 6/7/2017 5:55:29 AM

namespace Microsoft\BingAds\V11\CustomerBilling;

{
    /**
     * Defines a fault object that operations return when web service-specific errors occur, such as when the request message contains incomplete or invalid data.
     * @link http://msdn.microsoft.com/en-us/library/dn169108(v=msads.110).aspx ApiFault Data Object
     * 
     * @uses OperationError
     */
    class ApiFault extends ApplicationFault
    {
        public $OperationErrors;
    }

}
