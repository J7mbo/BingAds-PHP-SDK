<?php
// Generated on 6/7/2017 5:55:31 AM

namespace Microsoft\BingAds\V11\AdInsight;

{
    /**
     * Defines an object that contains a suggested keyword with historical statistics, like monthly search volume, competition, suggested minimum bid, and ad impression share.
     * @link http://msdn.microsoft.com/en-us/library/mt784422(v=msads.110).aspx KeywordIdea Data Object
     * 
     * @uses CompetitionLevel
     * @uses SourceType
     * @used-by GetKeywordIdeasResponse
     */
    final class KeywordIdea
    {
        /**
         * The Bing Ads identifier of the ad group that contains the keyword.
         * @var integer
         */
        public $AdGroupId;

        /**
         * The name of the ad group that contains the keyword.
         * @var string
         */
        public $AdGroupName;

        /**
         * Ad impression share is the number of impressions you've received divided by the total number of searches for the location and network you're targeting that matched the keyword exactly in the last calendar month.
         * @var double
         */
        public $AdImpressionShare;

        /**
         * The number of advertisers bidding on this keyword, relative to all other keywords across Bing Ads.
         * @var CompetitionLevel
         */
        public $Competition;

        /**
         * The suggested keyword.
         * @var string
         */
        public $Keyword;

        /**
         * The number of times this keyword was used as a search term for each month within the date range and targeting settings you've selected.
         * @var integer[]
         */
        public $MonthlySearchCounts;

        /**
         * The keyword relevance score.
         * @var double
         */
        public $Relevance;

        /**
         * The source or seed for the keyword.
         * @var SourceType
         */
        public $Source;

        /**
         * The suggested minimum bid for this keyword.
         * @var double
         */
        public $SuggestedBid;
    }

}
