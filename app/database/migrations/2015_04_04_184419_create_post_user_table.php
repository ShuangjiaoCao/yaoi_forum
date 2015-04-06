<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('post_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->timestamps();
		});



		Schema::table('post_user', function($table) {
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			


	});
}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_user');
	}

}
