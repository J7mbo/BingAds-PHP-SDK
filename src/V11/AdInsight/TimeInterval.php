<?php
// Generated on 6/7/2017 5:55:31 AM

namespace Microsoft\BingAds\V11\AdInsight;

{
    /**
     * Defines the possible time periods that determine the pool of data that the service uses to get the performance statistics of a keyword.
     * @link http://msdn.microsoft.com/en-us/library/mt219339(v=msads.110).aspx TimeInterval Value Set
     * 
     * @used-by GetHistoricalKeywordPerformanceRequest
     */
    final class TimeInterval
    {
        /** Use data from the previous calendar month. */
        const LastMonth = 'LastMonth';

        /** Use data from last week, Sunday through Saturday. */
        const LastWeek = 'LastWeek';

        /** Use data from yesterday. */
        const LastDay = 'LastDay';
    }

}
