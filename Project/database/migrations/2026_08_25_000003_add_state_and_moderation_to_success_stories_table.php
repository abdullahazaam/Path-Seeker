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
            $table->string('status')->default('draft')->after('submitted_by');
            $table->foreignId('reviewer_id')->nullable()->after('status')->constrained('users')->nullOnDelete();
            $table->text('rejection_reason')->nullable()->after('reviewer_id');
            $table->timestamp('reviewed_at')->nullable()->after('rejection_reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('success_stories', function (Blueprint $table) {
            $table->dropForeign(['reviewer_id']);
            $table->dropColumn(['status', 'reviewer_id', 'rejection_reason', 'reviewed_at']);
        });
    }
};
