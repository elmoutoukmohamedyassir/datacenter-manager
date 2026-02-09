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
    Schema::create('resources', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('type'); // Added: To distinguish between 'Serveur', 'VM', 'Switch', etc.
        $table->string('cpu')->nullable();
        $table->string('ram')->nullable();
        $table->string('os')->nullable();
        $table->string('location')->nullable(); // Changed to lowercase 'location'
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->foreignId('manager_id')->constrained('users')->onDelete('cascade');
        $table->json('specifications')->nullable(); // Made nullable just in case
        
        // Added: Better for the 'Suivi détaillé' requirement
        $table->enum('status', ['disponible', 'maintenance', 'indisponible'])->default('disponible');
        
        $table->boolean('is_active')->default(true); 
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
