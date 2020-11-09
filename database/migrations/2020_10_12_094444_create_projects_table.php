<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->increments('project_id')->unsigned();

            $table->string('project_name', 100);
            $table->unsignedInteger('client_id')->length(10);
            $table->unsignedInteger('manager_id')->length(10);

            $table->date('order_month')->nullable();
            $table->date('inspection_month')->nullable();
            $table->tinyInteger('order_status')->nullable();
            $table->tinyInteger('business_situation')->nullable();
            $table->tinyInteger('development_stage')->nullable();
            $table->bigInteger('sales_total')->nullable();
            $table->integer('transferred_amount')->nullable();

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
        Schema::dropIfExists('projects');
    }
}
