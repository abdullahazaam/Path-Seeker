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
        Schema::table('user_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('user_profiles', 'resume_path')) {
                $table->string('resume_path')->nullable()->after('profile_image');
            }
            if (!Schema::hasColumn('user_profiles', 'resume_filename')) {
                $table->string('resume_filename')->nullable()->after('resume_path');
            }
            if (!Schema::hasColumn('user_profiles', 'resume_updated_at')) {
                $table->timestamp('resume_updated_at')->nullable()->after('resume_filename');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            if (Schema::hasColumn('user_profiles', 'resume_updated_at')) {
                $table->dropColumn('resume_updated_at');
            }
            if (Schema::hasColumn('user_profiles', 'resume_filename')) {
                $table->dropColumn('resume_filename');
            }
            if (Schema::hasColumn('user_profiles', 'resume_path')) {
                $table->dropColumn('resume_path');
            }
        });
    }
};
