<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Settings table for API Keys and System Configurations
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Content Grid table for Weekly/Monthly AI Content Calendar
        Schema::create('content_grids', function (Blueprint $table) {
            $table->id();
            $table->string('topic');
            $table->string('category')->default('Normativa SEC');
            $table->enum('frequency', ['semanal', 'mensual'])->default('semanal');
            $table->date('scheduled_date');
            $table->enum('status', ['planned', 'generated', 'sent'])->default('planned');
            $table->foreignId('bulletin_id')->nullable()->constrained('bulletins')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_grids');
        Schema::dropIfExists('settings');
    }
};
