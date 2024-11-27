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
            $table->unsignedBigInteger('address_country_id')
                ->nullable();
            $table->string('address_postal_zip')
                ->nullable();
            $table->unsignedBigInteger('network_id')
                ->nullable();

            $table->softDeletes();

            $table->foreign('address_country_id')
                ->references('id')
                ->on('countries');

            $table->foreign('network_id')
                ->references('id')
                ->on('networks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advertisers', function (Blueprint $table) {
            $table->dropForeign('advertisers_address_country_id_foreign');
            $table->dropForeign('advertisers_network_id_foreign');

            $table->dropSoftDeletes();

            $table->dropColumn('description');
            $table->dropColumn('contact_name');
            $table->dropColumn('contact_email');
            $table->dropColumn('contact_phone_number');
            $table->dropColumn('address_country_id');
            $table->dropColumn('address_postal_zip');
            $table->dropColumn('network_id');
        });
    }
};
