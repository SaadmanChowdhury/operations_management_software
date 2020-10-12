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
            // $table->id();
            $table->Integer('assign_no')->primary();
            $table->string('project_id', 10);
            $table->Integer('staff_id');
            $table->double('last_year', 2);
            $table->tinyInteger('year');
            $table->tinyInteger('month');
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
