<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachments', function($table){
			$table->increments('id');
			$table->string('title');
			$table->text('file');
			$table->integer('lesson_id')->unsigned();
		    $table->foreign('lesson_id')->references('id')->on('lessons');
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
		Schema::drop('attachments');
	}

}
