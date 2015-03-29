<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
  {
    Schema::create('posts', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('title');
      $table->string('summary')->nullable();
      $table->string('name');
      $table->boolean('is18')->default(0);
      $table->integer('likes');


      $table->integer('user_id');

     // $table->integer('user_id')->unsigned();
     // $table->foreign('user_id')
       //     ->references('id')->on('users')
         //   ->onDelete('cascade');
      $table->text('resolved_content');
      $table->softDeletes();

      $table->text('content');
      $table->boolean('isEnd')->default(0);
     

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
    Schema::drop('posts');

   

  }

}
