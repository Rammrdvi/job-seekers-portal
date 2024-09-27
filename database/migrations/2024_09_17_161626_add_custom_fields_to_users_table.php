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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone');
            $table->integer('experience');
            $table->integer('notice_period');
            $table->text('skills');
            $table->string('job_location');
            $table->string('resume');
            $table->string('photo');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'experience', 'notice_period', 'skills', 'job_location', 'resume', 'photo'
            ]);
        });
    }
};
