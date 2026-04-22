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
        Schema::create('job_listings', function (Blueprint $table) {
             $table->id();
            $table->foreignId('employer_id')                   // FK to users.id
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->json('skills_required');                 // ["PHP", "MySQL"]
            $table->enum('type', ['fixed', 'hourly'])->default('fixed');
            $table->decimal('budget_min', 10, 2)->nullable();
            $table->decimal('budget_max', 10, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->string('duration')->nullable();          // "1 week", "3 months"
            $table->string('experience_level')->nullable();  // "entry", "mid", "senior"
            $table->enum('status', ['draft','open','in_progress','completed','cancelled'])
                  ->default('open');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_hidden')->default(false);   // Admin moderation
            $table->timestamp('deadline')->nullable();
            $table->unsignedInteger('application_count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('employer_id');
            $table->index('status');
            $table->index('is_featured');
            $table->index(['status', 'is_hidden']);
            $table->index('deadline');
            $table->fullText(['title', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
