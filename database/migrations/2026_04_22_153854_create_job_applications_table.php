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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')
                  ->constrained('job_listings')
                  ->cascadeOnDelete();
            $table->foreignId('freelancer_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->text('cover_letter');
            $table->decimal('proposed_rate', 10, 2)->nullable();
            $table->string('estimated_duration')->nullable();
            $table->enum('status', ['pending', 'reviewed', 'accepted', 'rejected'])
                  ->default('pending');
            $table->text('employer_notes')->nullable();    
            $table->timestamps();

            // Enforce one application per freelancer per job
            $table->unique(['job_id', 'freelancer_id']);
            $table->index('freelancer_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
