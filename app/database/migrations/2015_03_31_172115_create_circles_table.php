<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCirclesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
		public function up()
		{
		Schema::create('circles', function(Blueprint $table)
		{
   	 	$table->increments('id');
   	 	$table->string('name')->unique();
    	$table->integer('count')->default(0);
    	$table->softDeletes();
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
		Schema::drop('circles');
	}

}