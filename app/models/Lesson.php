<?php

class Lesson extends Eloquent{
	protected $guarded = array();
	public static $rules = array(
			'topic'=>'required',
			'content'=>'required'
		); 
}