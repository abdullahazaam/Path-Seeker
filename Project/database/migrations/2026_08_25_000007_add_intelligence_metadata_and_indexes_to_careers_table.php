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
            $table->string('salary_source_name')->nullable()->after('expected_salary');
            $table->string('source_url')->nullable()->after('salary_source_name');
            $table->string('source_date')->nullable()->after('source_url');
            $table->string('currency', 10)->default('USD')->after('source_date');
            $table->text('methodology_notes')->nullable()->after('currency');
            $table->string('confidence_level', 50)->default('Verified')->after('methodology_notes');

            // Indexes for fast autocomplete and filtered queries
            $table->index('domain');
            $table->index('target_role');
            $table->index('title');
            $table->index('expected_salary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('careers', function (Blueprint $table) {
            $table->dropIndex(['domain']);
            $table->dropIndex(['target_role']);
            $table->dropIndex(['title']);
            $table->dropIndex(['expected_salary']);
            $table->dropColumn([
                'salary_source_name',
                'source_url',
                'source_date',
                'currency',
                'methodology_notes',
                'confidence_level',
            ]);
        });
    }
};
