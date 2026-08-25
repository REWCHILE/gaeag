<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('content_grids', function (Blueprint $table) {
            $table->dateTime('scheduled_at')->nullable()->after('scheduled_date');
            $table->string('status', 30)->default('planned')->change();
        });

        Schema::table('bulletins', function (Blueprint $table) {
            $table->dateTime('scheduled_at')->nullable()->after('status');
            $table->string('status', 30)->default('draft')->change();
        });
    }

    public function down(): void
    {
        Schema::table('content_grids', function (Blueprint $table) {
            $table->dropColumn('scheduled_at');
        });

        Schema::table('bulletins', function (Blueprint $table) {
            $table->dropColumn('scheduled_at');
        });
    }
};
