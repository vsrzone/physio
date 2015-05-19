<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEssaysTable extends Migration {

	public function up()
	{
		Schema::create('essays', function($table)
		{
		    $table->increments('id');
		    $table->integer('member_id');
		    $table->integer('paper_id');
		    $table->text('answers');
		    $table->time('start_time');
		    $table->time('end_time');
		    $table->integer('acceptance_id');
			$table->string('marks')->nullable();
		    $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('essays');
	}

}
