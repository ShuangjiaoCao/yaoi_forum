<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	
		public function up()
	{
		Schema::table('posts', function(Blueprint $table)
		{
      $table->boolean('is_admin')->default(0);
		});
	
	}
	

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
