<?php
// Generated on 5/7/2017 5:48:19 AM

namespace Microsoft\BingAds\V11\Bulk;

{
    /**
     * Defines an error object that contains the details that explain why the service operation failed.
     * @link http://msdn.microsoft.com/en-us/library/dn169098(v=msads.110).aspx OperationError Data Object
     * 
     * @used-by ApiFaultDetail
     * @used-by GetBulkDownloadStatusResponse
     * @used-by GetBulkUploadStatusResponse
     */
    final class OperationError
    {
        /**
         * A numeric error code that identifies the error
         * @var integer
         */
        public $Code;

        /**
         * A message that provides additional details about the error.
         * @var string
         */
        public $Details;

        /**
         * A symbolic string constant that identifies the error.
         * @var string
         */
        public $ErrorCode;

        /**
         * A message that describes the error.
         * @var string
         */
        public $Message;
    }

}