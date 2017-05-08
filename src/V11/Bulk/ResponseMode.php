<?php
// Generated on 5/7/2017 5:48:19 AM

namespace Microsoft\BingAds\V11\Bulk;

{
    /**
     * Defines elements to specify whether the bulk service should return upload errors with their corresponding data.
     * @link http://msdn.microsoft.com/en-us/library/dn249983(v=msads.110).aspx ResponseMode Value Set
     * 
     * @used-by GetBulkUploadUrlRequest
     */
    final class ResponseMode
    {
        /** Return errors only in the bulk upload response file. */
        const ErrorsOnly = 'ErrorsOnly';

        /** Return errors and results in the bulk upload response file. */
        const ErrorsAndResults = 'ErrorsAndResults';
    }

}