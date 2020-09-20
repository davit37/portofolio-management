<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTrsPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trs_plans', function (Blueprint $table) {
            $table->renameColumn("pair",'pair_id');
        });
        Schema::table('trs_plans', function (Blueprint $table) {
            $table->bigInteger("pair_id")->unsigned()->change();
            $table->foreign('pair_id')->references('id')->on('mst_pairs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trs_plans', function (Blueprint $table) {
            $table->dropForeign("pair_id");
            $table->renameColumn("pair_id",'pair');
         

        });

        Schema::table('trs_plans', function (Blueprint $table) {
            
            $table->string("pair")->change();

        });
    }
}
