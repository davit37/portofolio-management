<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTrsPlans2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trs_plans', function (Blueprint $table) {
            $table->integer("status_pl")->comment("0:Need Approval, 1:Approved, 2:Cancel");
            $table->renameColumn("status",'status_order');
        });

        Schema::table('trs_plan_rr', function (Blueprint $table) {
            $table->decimal("profit_loss",20,0)->nullable();
            $table->renameColumn("entry",'entry_price');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('trs_plans', function (Blueprint $table) {
            // $table->dropForeign('id'); 
            $table->dropColumn("status_pl");
            $table->renameColumn("status_order",'status');
        });
        Schema::table('trs_plan_rr', function (Blueprint $table) {
            $table->dropColumn("profit_loss");
            $table->renameColumn("entry_price",'entry');


        });
        Schema::enableForeignKeyConstraints();
    }
}
