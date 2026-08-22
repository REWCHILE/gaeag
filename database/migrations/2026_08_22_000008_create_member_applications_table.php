<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('rut');
            $table->string('sec_licence')->nullable();
            $table->string('category')->default('Gas');
            $table->string('class')->nullable()->default('Clase B SEC');
            $table->string('phone');
            $table->string('email');
            $table->string('city');
            $table->string('region');
            $table->text('bio')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_applications');
    }
};
