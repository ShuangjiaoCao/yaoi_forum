<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
  {
    Schema::create('updates', function(Blueprint $table)
    {
      $table->increments('id');

      $table->text('content');
      $table->boolean('is18')->default(0);
      $table->boolean('inEnd')->default(0);
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
