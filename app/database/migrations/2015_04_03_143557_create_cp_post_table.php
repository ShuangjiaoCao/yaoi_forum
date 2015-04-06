<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCpPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cp_post', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cp_id')->unsigned()->index();		
			$table->integer('post_id')->unsigned()->index();
			
			$table->timestamps();
		});


	Schema::table('cp_post', function($table) {
      $table->foreign('cp_id')->references('id')->on('cps')->onDelete('cascade');
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
		Schema::drop('cp_post');
	}

}

