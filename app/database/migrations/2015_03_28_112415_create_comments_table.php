<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	public function up()
  {
    Schema::create('comments', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('name');
      $table->text('content');
      //$table->integer('post_id')->unsigned();
     // $table->foreign('post_id')
       //     ->references('id')->on('posts')
         //   ->onDelete('cascade');


      $table->integer('post_id');
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
    Schema::drop('comments');
  }

}
