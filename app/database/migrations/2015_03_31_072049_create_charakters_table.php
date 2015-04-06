<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatecharaktersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	
	public function up()
		{
		Schema::create('charakters', function(Blueprint $table)
		{
   	 	$table->increments('id');
   	 	$table->string('name')->unique();
    	$table->integer('count')->default(0);
    	$table->softDeletes();
    	$table->timestamps();
    	$table->integer('circle_id');

			});
		}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('charakters');
	}

}
