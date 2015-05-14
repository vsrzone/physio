<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcceptancesTableAlterMarks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('acceptances', function($table)
		{
		    $table->increments('id');
		    $table->boolean('state')->nullable();
		    $table->integer('member_id');
		    $table->integer('paper_id');
		    $table->timestamps();
		});

		Schema::table('marks', function($table) {
			$table->integer('acceptance_id');
			$table->string('marks');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('acceptances');
		Schema::table('mcqs', function($table) {
			$table->dropColumn('acceptance_id');
			$table->dropColumn('marks')->nullable();
		});
	}

}
