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
        Schema::create('reviews', function (Blueprint $table) {
              $table->id();
            $table->foreignId('job_id')
                  ->constrained('job_listings')
                  ->cascadeOnDelete();
            $table->foreignId('application_id')
                  ->constrained('job_applications')
                  ->cascadeOnDelete();
            $table->foreignId('reviewer_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->foreignId('reviewee_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->unsignedTinyInteger('rating');            // 1–5
            $table->text('comment');
            $table->boolean('is_hidden')->default(false);     // Admin moderation
            $table->timestamps();

            // One review per reviewer per application
            $table->unique(['application_id', 'reviewer_id']);
            $table->index('reviewee_id');
            $table->index('rating');
            $table->index('is_hidden');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
