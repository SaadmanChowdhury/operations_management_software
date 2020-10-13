<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            // $table->id();
            $table->string('project_id', 10)->primary();
            $table->Integer('customer_id');
            $table->string('project_name', 100);
            $table->Integer('manager_id');
            $table->date('order_month')->nullable();
            $table->date('inspection_month')->nullable();
            $table->tinyInteger('prospect')->nullable();
            $table->tinyInteger('situation_id')->nullable();
            $table->tinyInteger('work_engineering_id')->nullable();
            $table->bigInteger('amount_of_sales')->nullable();
            $table->Integer('transfer_amount')->nullable();
            $table->string('estimate_id', 16); // it should be integer as it's an id
            $table->tinyInteger('estimate_status_id')->nullable();
            $table->string('remark', 100)->nullable();
            $table->string('ec_estimate_storage_location', 100)->nullable();

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
        Schema::dropIfExists('projects');
    }
}
