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
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropForeign('campaigns_advertiser_foreign');
            $table->renameColumn('advertiser', 'advertiser_id');
            $table->foreign('advertiser_id')
                ->references('id')
                ->on('advertisers');

            $table->dropForeign('campaigns_network_foreign');
            $table->renameColumn('network', 'network_id');
            $table->foreign('network_id')
                ->references('id')
                ->on('networks');
        });
        Schema::table('conversions', function (Blueprint $table) {
            $table->dropForeign('conversions_campaign_foreign');
            $table->renameColumn('campaign', 'campaign_id');
            $table->foreign('campaign_id')
                ->references('id')
                ->on('campaigns');
        });

        Schema::table('publishers', function (Blueprint $table) {
            $table->dropForeign('publishers_network_foreign');
            $table->renameColumn('network', 'network_id');
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
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropForeign('campaigns_advertiser_id_foreign');
            $table->renameColumn('advertiser_id', 'advertiser');
            $table->foreign('advertiser')
                ->references('id')
                ->on('advertisers');

            $table->dropForeign('campaigns_network_id_foreign');
            $table->renameColumn('network_id', 'network');
            $table->foreign('network')
                ->references('id')
                ->on('networks');
        });
        Schema::table('conversions', function (Blueprint $table) {
            $table->dropForeign('conversions_campaign_id_foreign');
            $table->renameColumn('campaign_id', 'campaign');
            $table->foreign('campaign')
                ->references('id')
                ->on('campaigns');
        });

        Schema::table('publishers', function (Blueprint $table) {
            $table->dropForeign('publishers_network_id_foreign');
            $table->renameColumn('network_id', 'network');
            $table->foreign('network')
                ->references('id')
                ->on('networks');
        });
    }
};
