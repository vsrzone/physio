<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTables extends Migration {

	public function up()
	{
		Schema::create('mcqs', function($table)
		{
		    $table->increments('id');
		    $table->text('paper');
		    $table->string('title');
		    $table->text('description');
		    $table->integer('duration');
		    $table->timestamps();
		});

		Schema::create('marks', function($table)
		{
		    $table->increments('id');
		    $table->integer('member_id');
		    $table->integer('paper_id');
		    $table->time('start_time');
		    $table->time('end_time');
		    $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('mcqs');
		Schema::drop('marks');
	}

}
