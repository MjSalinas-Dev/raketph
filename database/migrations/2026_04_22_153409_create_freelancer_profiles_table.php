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
        Schema::create('freelancer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->unique()
                  ->constrained()
                  ->cascadeOnDelete();
            $table->string('headline')->nullable();          // "Senior PHP Developer"
            $table->text('bio')->nullable();
            $table->json('skills')->nullable();              // ["PHP", "Vue.js", "MySQL"]
            $table->decimal('hourly_rate', 8, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->enum('availability', ['available', 'busy', 'unavailable'])->default('available');
            $table->string('location')->nullable();
            $table->string('website_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('github_url')->nullable();
            $table->unsignedInteger('experience_years')->nullable();
            $table->decimal('avg_rating', 3, 2)->default(0.00);
            $table->unsignedInteger('review_count')->default(0);
            $table->unsignedInteger('completed_jobs')->default(0);
            $table->boolean('is_verified')->default(false);
            $table->boolean('profile_complete')->default(false);
            $table->timestamps();

            $table->index('availability');
            $table->index('avg_rating');
            $table->index('hourly_rate');
            $table->fullText(['headline', 'bio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_profiles');
    }
};
