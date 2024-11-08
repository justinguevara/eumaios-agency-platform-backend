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
        Schema::table('advertisers', function (Blueprint $table) {
            $table->text('description')
                ->nullable();
            $table->string('contact_name')
                ->nullable();
            $table->string('contact_email')
                ->nullable();
            $table->string('contact_phone_number')
                ->nullable();
            $table->unsignedBigInteger('address_country')
                ->nullable();
            $table->string('address_postal_zip')
                ->nullable();

            $table->softDeletes();

            $table->foreign('address_country')
                ->references('id')
                ->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertisers', function (Blueprint $table) {
            $table->dropForeign('advertisers_address_country_foreign');

            $table->dropSoftDeletes();

            $table->dropColumn('description');
            $table->dropColumn('contact_name');
            $table->dropColumn('contact_email');
            $table->dropColumn('contact_phone_number');
            $table->dropColumn('address_country');
            $table->dropColumn('address_postal_zip');
            $table->dropColumn('network');
        });
    }
};
