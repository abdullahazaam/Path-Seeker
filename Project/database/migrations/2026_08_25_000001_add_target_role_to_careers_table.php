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
        Schema::table('careers', function (Blueprint $table) {
            if (!Schema::hasColumn('careers', 'target_role')) {
                $table->string('target_role')->default('all')->after('expected_salary');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('careers', function (Blueprint $table) {
            if (Schema::hasColumn('careers', 'target_role')) {
                $table->dropColumn('target_role');
            }
        });
    }
};
