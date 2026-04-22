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
        Schema::create('portfolios', function (Blueprint $table) {
             $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('project_url')->nullable();       // External link
            $table->string('image_path')->nullable();        // Uploaded image
            $table->json('tags')->nullable();                // Skills used
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index('user_id');
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
