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
            $table->Integer('assign_no')->primary(); // won't it be better to use id or assign_id
            $table->string('project_id', 10); // it should be int as it is an id
            $table->Integer('staff_id');
            $table->double('last_year', 2); // why it is double ? if it is double then shouldn't it be like $table->double('last_year', 10, 2);
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
