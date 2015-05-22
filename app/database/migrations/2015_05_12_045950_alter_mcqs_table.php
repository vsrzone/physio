<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMcqsTable extends Migration {

	public function up()
	{
		//adding the type column to the mcqs table

		Schema::table('mcqs', function($table) {
			$table->boolean('type');
		});
	}

	public function down()
	{
		//dropping the type column from the mcqs table

		Schema::table('mcqs', function($table) {
			$table->dropColumn('type');
		});
	}

}
