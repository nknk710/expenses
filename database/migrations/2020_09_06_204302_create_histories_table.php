<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('ユーザID'); //usersテーブルのidと関連付け
            $table->date('date')->comment('支出の日時');
            $table->string('category')->comment('支出の種類');
            $table->string('content')->commment('支出の内容');
            $table->integer('cost')->comment('金額');
            $table->timestamps();
            
            $table->index('id');
            $table->index('user_id');
            $table->index('date');
            $table->index('category');
            $table->index('content');
            $table->index('cost');
            
            //外部キー制約
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
