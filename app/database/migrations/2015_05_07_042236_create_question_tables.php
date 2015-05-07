<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTables extends Migration {

	public function up()
	{
		Schema::create('questions', function($table)
		{
		    $table->increments('id');
		    $table->text('paper');
		    $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('questions');
	}

}
