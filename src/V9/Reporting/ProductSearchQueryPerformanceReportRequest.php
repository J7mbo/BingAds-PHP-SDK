<?php
// Generated on 6/7/2017 5:53:08 AM

namespace Microsoft\BingAds\V9\Reporting;

{
    /**
     * Defines a Bing Shopping campaign product search query performance report request.
     * @link http://msdn.microsoft.com/en-us/library/mt801312(v=msads.90).aspx ProductSearchQueryPerformanceReportRequest Data Object
     * 
     * @uses ReportAggregation
     * @uses ProductSearchQueryPerformanceReportColumn
     * @uses ProductSearchQueryPerformanceReportFilter
     * @uses AccountThroughAdGroupReportScope
     * @uses ReportTime
     */
    final class ProductSearchQueryPerformanceReportRequest extends ReportRequest
    {
        /**
         * The type of aggregation to use to aggregate the report data.
         * @var ReportAggregation
         */
        public $Aggregation;

        /**
         * The list of attributes and performance statistics to include in the report.
         * @var ProductSearchQueryPerformanceReportColumn[]
         */
        public $Columns;

        /**
         * The filter information to use to filter the report data.
         * @var ProductSearchQueryPerformanceReportFilter
         */
        public $Filter;

        /**
         * The scope of the report.
         * @var AccountThroughAdGroupReportScope
         */
        public $Scope;

        /**
         * The time period to use for the report.
         * @var ReportTime
         */
        public $Time;
    }

}
