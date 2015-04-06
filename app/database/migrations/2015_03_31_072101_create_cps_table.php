<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCpsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
		{
		Schema::create('cps', function(Blueprint $table)
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
		Schema::drop('cps');
	}

}
