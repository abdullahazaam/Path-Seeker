<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('success_stories', function (Blueprint $table) {
            if (!Schema::hasColumn('success_stories', 'timeline_path')) {
                $table->text('timeline_path')->nullable()->after('story_text');
            }
            if (!Schema::hasColumn('success_stories', 'educational_path')) {
                $table->text('educational_path')->nullable()->after('timeline_path');
            }
            if (!Schema::hasColumn('success_stories', 'challenges')) {
                $table->text('challenges')->nullable()->after('educational_path');
            }
            if (!Schema::hasColumn('success_stories', 'outcome')) {
                $table->text('outcome')->nullable()->after('challenges');
            }
            if (!Schema::hasColumn('success_stories', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('submitted_by')->constrained('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('success_stories', function (Blueprint $table) {
            if (Schema::hasColumn('success_stories', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('success_stories', 'outcome')) {
                $table->dropColumn('outcome');
            }
            if (Schema::hasColumn('success_stories', 'challenges')) {
                $table->dropColumn('challenges');
            }
            if (Schema::hasColumn('success_stories', 'educational_path')) {
                $table->dropColumn('educational_path');
            }
            if (Schema::hasColumn('success_stories', 'timeline_path')) {
                $table->dropColumn('timeline_path');
            }
        });
    }
};
