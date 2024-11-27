<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn('network');

            $table->dropForeign('campaigns_advertiser_foreign');
            $table->dropColumn('advertiser');

            $table->unsignedBigInteger('advertiser_id')
                ->nullable();
            $table->foreign('advertiser_id')
                ->references('id')
                ->on('advertisers');
        });
    }

    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropForeign('campaigns_advertiser_id_foreign');
            $table->dropColumn('advertiser_id');

            $table->unsignedBigInteger('advertiser')
                ->nullable();
            $table->foreign('advertiser')
                ->references('id')
                ->on('advertisers');

            $table->unsignedBigInteger('network')
                ->nullable();
        });
    }
};
