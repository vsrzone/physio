<?php

class Mcq extends Eloquent
{

	protected $guarded = array();

	public static $rules = array(
		'title'	=> 'required',
		'paper'	=> 'required'
		);
}