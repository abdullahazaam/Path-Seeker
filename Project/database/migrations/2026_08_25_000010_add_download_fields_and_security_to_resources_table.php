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
        Schema::table('resources', function (Blueprint $table) {
            $table->text('description')->nullable()->after('category');
            $table->string('file_type', 20)->default('pdf')->after('file_url');
            $table->boolean('is_premium')->default(false)->after('file_type');
            $table->boolean('is_private')->default(false)->after('is_premium');
            $table->unsignedInteger('download_count')->default(0)->after('is_private');
            $table->text('preview_content')->nullable()->after('download_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'file_type',
                'is_premium',
                'is_private',
                'download_count',
                'preview_content',
            ]);
        });
    }
};
