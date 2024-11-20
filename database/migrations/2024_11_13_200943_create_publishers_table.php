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
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
 
            $table->string('name');
            $table->text('description')
                ->nullable();
            $table->string('contact_name')
                ->nullable();
            $table->string('contact_email')
                ->nullable();
            $table->string('contact_phone_number')
                ->nullable();
            $table->string('address_street_1')
                ->nullable();
            $table->string('address_street_2')
                ->nullable();
            $table->string('address_city')
                ->nullable();
            $table->string('address_region')
                ->nullable();
            $table->unsignedBigInteger('address_country_id')
                ->nullable();
            $table->string('address_postal_zip')
                ->nullable();
            $table->unsignedBigInteger('network')
                ->nullable();

            $table->dateTime('created_at')
                ->nullable();
            $table->dateTime('updated_at')
                ->nullable();
            $table->softDeletes();
    
            $table->foreign('address_country_id')
                ->references('id')
                ->on('countries');
            $table->foreign('network')
                ->references('id')
                ->on('networks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publishers');
    }
};
