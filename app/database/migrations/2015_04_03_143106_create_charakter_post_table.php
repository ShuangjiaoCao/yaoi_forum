<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCharakterPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('charakter_post', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('charakter_id')->unsigned()->index();
			
			$table->integer('post_id')->unsigned()->index();
			
			$table->timestamps();
		});

	Schema::table('charakter_post', function($table) {
      $table->foreign('charakter_id')->references('id')->on('charakters')->onDelete('cascade');
     $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

   });

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('charakter_post');
	}

}
