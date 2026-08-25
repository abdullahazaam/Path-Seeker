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
        Schema::table('feedback', function (Blueprint $table) {
            $table->text('admin_response')->nullable()->after('status');
            $table->foreignId('responded_by')->nullable()->after('admin_response')->constrained('users')->nullOnDelete();
            $table->timestamp('responded_at')->nullable()->after('responded_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->dropForeign(['responded_by']);
            $table->dropColumn(['admin_response', 'responded_by', 'responded_at']);
        });
    }
};
