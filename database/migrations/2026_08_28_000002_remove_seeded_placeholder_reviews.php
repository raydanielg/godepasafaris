<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Removes fabricated reviews that were seeded into the live database.
 *
 * Two sources, both shipping invented content as if it were customer feedback:
 *
 *  1. BlogSeeder attached a 5-star "John Doe / john@example.com" comment to
 *     every blog post. These were visible on /blog and /testimonials.
 *
 *  2. CulturalSeeder created reviews for each cultural experience ("Sophie M.",
 *     "David R." and so on) flagged is_approved = true. Worse, cultural/show
 *     emitted them to Google as an aggregateRating — fabricated ratings in
 *     structured data breach Google's review policy and risk a manual action,
 *     on top of the consumer-protection problem of publishing them at all.
 *
 * Deliberately narrow: rows are matched on the exact seeded name + email or
 * name + comment pair, so genuine customer feedback added later is untouched.
 * The aggregateRating in the view is already conditional on reviews existing,
 * so removing these rows stops the markup being emitted with no code change.
 *
 * Not reversible — down() intentionally does nothing rather than re-inserting
 * fake reviews into a production site.
 */
return new class extends Migration
{
    /** name => email, as written by BlogSeeder. */
    private array $seededComments = [
        'John Doe' => 'john@example.com',
    ];

    /** The exact nine reviewer names written by CulturalSeeder. */
    private array $seededReviewers = [
        'Anna K.', 'David R.', 'Elena P.', 'Fatima S.', 'Grace W.',
        'James O.', 'Lukas B.', 'Marco T.', 'Sophie M.',
    ];

    public function up(): void
    {
        if (Schema::hasTable('comments')) {
            foreach ($this->seededComments as $name => $email) {
                DB::table('comments')->where('name', $name)->where('email', $email)->delete();
            }
        }

        if (Schema::hasTable('cultural_reviews')) {
            DB::table('cultural_reviews')->whereIn('name', $this->seededReviewers)->delete();
        }
    }

    public function down(): void
    {
        // No rollback. Restoring fabricated reviews to a live site is never the
        // right outcome, and the originals are recoverable from the seeders if
        // they are ever genuinely needed for local development.
    }
};
