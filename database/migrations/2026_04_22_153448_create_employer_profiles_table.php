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
        Schema::create('employer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->unique()
                  ->constrained()
                  ->cascadeOnDelete();
            $table->string('company_name')->nullable();
            $table->string('industry')->nullable();
            $table->text('company_description')->nullable();
            $table->string('company_size')->nullable();      // "1-10", "11-50", "51-200", "200+"
            $table->string('website_url')->nullable();
            $table->string('location')->nullable();
            $table->string('logo')->nullable();
            $table->decimal('avg_rating', 3, 2)->default(0.00);
            $table->unsignedInteger('review_count')->default(0);
            $table->unsignedInteger('jobs_posted')->default(0);
            $table->boolean('profile_complete')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employer_profiles');
    }
};
