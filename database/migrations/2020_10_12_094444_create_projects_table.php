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
            $table->tinyInteger('order_status')->nullable();
            $table->tinyInteger('business_situation')->nullable();
            $table->tinyInteger('development_stage')->nullable();
            $table->bigInteger('sales_total')->nullable();
            $table->Integer('transferred_amount')->nullable();

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
