<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign', function (Blueprint $table) {
            $table->increments('assign_id')->unsigned();

            $table->unsignedInteger('project_id')->length(10);
            $table->unsignedInteger('staff_id')->length(10);
            $table->unsignedInteger('year')->length(4);
            $table->unsignedInteger('month')->length(2);

            $table->double('plan_month_year', 2)->nullable();
            $table->double('execution', 2)->nullable();

            $table->unsignedInteger('created_id')->nullable();
            $table->unsignedInteger('updated_id')->nullable();
            $table->unsignedInteger('deleted_id')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assign');
    }
}