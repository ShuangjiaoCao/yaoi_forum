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
       $table->integer('index');
	  $table->boolean('isUpdate')->default(0);
      $table->boolean('is18')->default(null);

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
