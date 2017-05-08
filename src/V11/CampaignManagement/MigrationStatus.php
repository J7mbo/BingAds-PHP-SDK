<?php
// Generated on 5/7/2017 5:48:20 AM

namespace Microsoft\BingAds\V11\CampaignManagement;

{
    /**
     * Defines the possible migration status values.
     * @link http://msdn.microsoft.com/en-us/library/mt706123(v=msads.110).aspx MigrationStatus Value Set
     * 
     * @used-by MigrationStatusInfo
     */
    final class MigrationStatus
    {
        /** None of the accounts for the customer are in the queue for the corresponding migration type. */
        const NotInPilot = 'NotInPilot';

        /** The account is in the queue for the corresponding migration type, but the migration has not yet begun. */
        const NotStarted = 'NotStarted';

        /** The migration is in progress. */
        const InProgress = 'InProgress';

        /** The migration is complete, or migration is not needed because the account was created after all of the customer's other accounts were added to the pilot queue for the corresponding migration type. */
        const Completed = 'Completed';
    }

}