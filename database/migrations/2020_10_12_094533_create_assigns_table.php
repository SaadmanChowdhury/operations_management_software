<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigns', function (Blueprint $table) {
            $table->Integer('assign_id')->primary();
            $table->Integer('project_id', 10);
            $table->Integer('staff_id');
            $table->tinyInteger('year')->nullable();
            $table->tinyInteger('month')->nullable();
            $table->double('plan_month_year', 2)->nullable();
            $table->double('execution', 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assigns');
    }
}
