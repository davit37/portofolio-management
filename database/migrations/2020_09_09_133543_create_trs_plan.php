<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("plan_no");
            $table->dateTime("entry_date");
            $table->string("pair");
            $table->integer("status")->comment("1:loss,2:win,3:floating,4:pending");
            $table->string("trading_rule")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('trs_plan_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("type")->comment("1:open,2:exit,3:one weak after exit");
            $table->bigInteger("plan_id")->unsigned();
            $table->string("file_name");
            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('trs_plans');
        });

        Schema::create('trs_plan_rr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("plan_id")->unsigned();
            $table->decimal("take_profit")->nullable();
            $table->decimal("stop_loss",20,6)->nullable();
            $table->string("risk_to_reward_ratio")->nullable();
            $table->decimal("risk_percentase",10,2)->nullable();
            $table->decimal("lot",8,3)->nullable();
            $table->decimal("entry",20,6)->nullable();
            $table->decimal("exit_price",20,6)->nullable();
            $table->integer("position")->comment("1:buy limit, 2:sell limit, 3:buy stop, 4:sell Stop, 5:buy market, 6:sell market ");
            $table->integer("status")->comment("1:hit profit,2:hit loss, 3:cut profit, 4:cut loss");
            $table->timestamps();
            
            $table->foreign('plan_id')->references('id')->on('trs_plans');
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
        Schema::dropIfExists('trs_plans');
        Schema::dropIfExists('trs_plan_images');
        Schema::dropIfExists('trs_plan_rr');
        Schema::enableForeignKeyConstraints();
    }
}
