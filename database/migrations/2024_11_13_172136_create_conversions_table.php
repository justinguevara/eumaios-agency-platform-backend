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
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();

            $table->string('conversion_type');

            $table->dateTime('created_at')
                ->nullable();
            $table->dateTime('updated_at')
                ->nullable();

            $table->unsignedBigInteger('campaign');

            $table->foreign('campaign')->references('id')->on('campaigns');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversions');
    }
};
