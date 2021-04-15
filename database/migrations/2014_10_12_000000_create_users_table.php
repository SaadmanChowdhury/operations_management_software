<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->integer('gender')->nullable();
            $table->enum('location', ['宮崎', '東京', '福岡'])->nullable();
            $table->string('tel');
            $table->enum('position', ['PM', 'PL', 'SE', 'PG'])->nullable();
            $table->date('admission_day');
            $table->date('exit_day')->nullable();
            $table->integer('unit_price');
            $table->enum('user_authority', ['システム管理者', '一般管理者', '一般ユーザー']);
            $table->date('resign_day')->nullable();

            $table->integer('user_list_preference')->default(0);
            $table->integer('client_list_preference')->default(0);
            $table->integer('project_list_preference')->default(0);
            $table->integer('assign_summary_preference')->default(0);

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
        Schema::dropIfExists('users');
    }
}
