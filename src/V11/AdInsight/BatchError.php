<?php
// Generated on 6/7/2017 5:55:31 AM

namespace Microsoft\BingAds\V11\AdInsight;

{
    /**
     * Defines an error object that identifies the item within the batch of items in the request message that caused the operation to fail, and describes the reason for the failure.
     * @link http://msdn.microsoft.com/en-us/library/mt219322(v=msads.110).aspx BatchError Data Object
     * 
     * @used-by ApiFaultDetail
     */
    final class BatchError
    {
        /**
         * A numeric error code that identifies the error.
         * @var integer
         */
        public $Code;

        /**
         * A message that provides additional details about the batch error.
         * @var string
         */
        public $Details;

        /**
         * A symbolic string constant that identifies the error.
         * @var string
         */
        public $ErrorCode;

        /**
         * The zero-based index of the item in the batch of items in the request message that failed.
         * @var integer
         */
        public $Index;

        /**
         * A message that describes the error.
         * @var string
         */
        public $Message;
    }

}
