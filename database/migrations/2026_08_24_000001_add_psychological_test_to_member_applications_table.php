<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('member_applications', function (Blueprint $table) {
            $table->string('test_token')->nullable()->unique()->after('status');
            $table->enum('psych_status', ['pending', 'completed'])->default('pending')->after('test_token');
            $table->integer('psych_score_total')->nullable()->after('psych_status');
            $table->integer('psych_score_safety')->nullable()->after('psych_score_total');
            $table->integer('psych_score_stress')->nullable()->after('psych_score_safety');
            $table->integer('psych_score_ethics')->nullable()->after('psych_score_stress');
            $table->integer('psych_score_service')->nullable()->after('psych_score_ethics');
            $table->integer('psych_score_responsibility')->nullable()->after('psych_score_service');
            $table->string('psych_risk_level', 50)->nullable()->after('psych_score_responsibility'); // Bajo, Medio, Alto
            $table->text('psych_profile_summary')->nullable()->after('psych_risk_level');
            $table->json('psych_answers')->nullable()->after('psych_profile_summary');
            $table->timestamp('psych_completed_at')->nullable()->after('psych_answers');
        });
    }

    public function down(): void
    {
        Schema::table('member_applications', function (Blueprint $table) {
            $table->dropColumn([
                'test_token',
                'psych_status',
                'psych_score_total',
                'psych_score_safety',
                'psych_score_stress',
                'psych_score_ethics',
                'psych_score_service',
                'psych_score_responsibility',
                'psych_risk_level',
                'psych_profile_summary',
                'psych_answers',
                'psych_completed_at',
            ]);
        });
    }
};
