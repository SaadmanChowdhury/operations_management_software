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
            $table->string('project_code', 100)->unique();
            $table->unsignedInteger('client_id')->length(10);
            $table->string('project_name', 100);
            $table->unsignedInteger('manager_id')->length(10);

            $table->date('order_month')->nullable();
            $table->date('inspection_month')->nullable();
            $table->enum('order_status', ['A', 'B', 'C', 'Z', '●'])->nullable();
            $table->enum('business_situation', ['見積前', '見積中', '見積済', '受注', '検収中', '完了'])->nullable();
            $table->enum('development_stage', ['受注前着手', '要件', '設計', '実装', 'テスト', '開発完了'])->nullable();
            $table->bigInteger('sales_total')->nullable();
            $table->bigInteger('transferred_amount')->nullable();
            $table->bigInteger('budget')->nullable();

            $table->unsignedInteger('estimate_id')->nullable();
            // $table->string('working_process', 100)->nullable();
            $table->unsignedInteger('department_sales')->nullable();
            $table->unsignedInteger('cost_of_sales')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('active_status')->default(true);

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
