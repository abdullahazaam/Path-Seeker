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
            if (!Schema::hasColumn('user_profiles', 'skills')) {
                $table->text('skills')->nullable()->after('interests');
            }
            if (!Schema::hasColumn('user_profiles', 'work_experience')) {
                $table->text('work_experience')->nullable()->after('skills');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            if (Schema::hasColumn('user_profiles', 'work_experience')) {
                $table->dropColumn('work_experience');
            }
            if (Schema::hasColumn('user_profiles', 'skills')) {
                $table->dropColumn('skills');
            }
        });
    }
};
