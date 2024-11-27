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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
 
            $table->string('name');
            $table->text('description')
                ->nullable();
            $table->string('conversion_type');
            $table->enum('campaign_status', ['pending', 'active', 'inactive',])
                ->default('pending');

            $table->dateTime('created_at')
                ->nullable();
            $table->dateTime('updated_at')
                ->nullable();

            $table->unsignedBigInteger('advertiser');
            $table->unsignedBigInteger('network');

            $table->foreign('advertiser')->references('id')->on('advertisers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
