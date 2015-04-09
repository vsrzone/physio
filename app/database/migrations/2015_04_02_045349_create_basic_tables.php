<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasicTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('nic');
			$table->string('concil_registration_no');
			$table->boolean('sex');
			$table->string('district');
			$table->string('hospital')->nullable();
			$table->string('address')->nullable();
			$table->string('tp1');
			$table->string('tp2')->nullable();
			$table->string('tp3')->nullable();
			$table->string('profile_picture')->nullable();
			$table->string('cover_picture')->nullable();
			$table->text('description')->nullable();
			$table->string('qualifications')->nullable();
		    $table->string('experience')->nullable();
			$table->integer('created_by');
			$table->integer('updated_by')->nullable();
			$table->timestamps();
		});

		Schema::create('users', function($table){
			$table->increments('id');
			$table->string('email');
			$table->string('password');
			$table->integer('type');
			$table->integer('member_id')->unsigned();
		    $table->foreign('member_id')->references('id')->on('members');
			$table->rememberToken();
			$table->timestamps();
		});

		Schema::create('categories', function($table){
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('news', function($table){
			$table->increments('id');
			$table->string('title');
			$table->boolean('active');
			$table->boolean('members_only');
			$table->integer('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('categories');
			$table->dateTime('news_date');
			$table->text('content');
			$table->integer('created_by');
			$table->timestamps();
		});

		Schema::create('images', function($table){
			$table->increments('id');
			$table->string('name');
			$table->integer('news_id')->unsigned();
			$table->foreign('news_id')->references('id')->on('news');
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
		Schema::drop('users');
		Schema::drop('categories');
		Schema::drop('news');
		Schema::drop('images');
		Schema::drop('memebers');
	}

}
