<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('status', 20)
                ->default('new')
                ->after('ai_reply')
                ->index();

            $table->unsignedInteger('ai_processing_time')
                ->nullable()
                ->comment('AI response time in milliseconds')
                ->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'ai_processing_time',
            ]);
        });
    }
};
