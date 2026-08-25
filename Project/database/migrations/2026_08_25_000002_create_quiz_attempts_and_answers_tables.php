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
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('quiz_version')->default('2026.v1');
            $table->json('domain_scores');
            $table->integer('total_score')->default(0);
            $table->string('top_domain');
            $table->json('recommended_careers');
            $table->string('idempotency_token', 64)->nullable()->unique();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_attempt_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('question_id')->index();
            $table->text('question_text');
            $table->string('selected_option', 10);
            $table->text('selected_option_text');
            $table->string('domain_awarded');
            $table->integer('points_awarded')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_answers');
        Schema::dropIfExists('quiz_attempts');
    }
};
