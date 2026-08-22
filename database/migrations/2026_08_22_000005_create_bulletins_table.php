<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bulletins', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subject');
            $table->text('content_html');
            $table->enum('status', ['draft', 'sending', 'sent'])->default('draft');
            $table->string('category')->default('Normativa SEC');
            $table->text('ai_prompt_used')->nullable();
            $table->integer('sent_count')->default(0);
            $table->integer('total_recipients')->default(0);
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bulletins');
    }
};
