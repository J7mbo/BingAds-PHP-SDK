<?php
// Generated on 6/7/2017 5:54:05 AM

namespace Microsoft\BingAds\V10\AdInsight;

{
    /**
     * Given a list of existing keywords, this operation returns for each a list of suggested bids and estimated performance statistics from 1 to 7 days.
     * @link http://msdn.microsoft.com/en-us/library/mt219285(v=msads.100).aspx GetBidLandscapeByKeywordIds Response Object
     * 
     * @uses KeywordBidLandscape
     * @used-by BingAdsAdInsightService::GetBidLandscapeByKeywordIds
     */
    final class GetBidLandscapeByKeywordIdsResponse
    {
        /**
         * An array of KeywordBidLandscape objects.
         * @var KeywordBidLandscape[]
         */
        public $BidLandscape;
    }
}
