<?php

/*
	Name:		News
	Purpose:	Database class for News table

	History:	Created 02/04/2015 by buddhi ashan	 
*/


class News extends Eloquent
{
	protected $guarded = array();

	public static $rules = array(
		'title'=>'required',
		'category_id'=>'required',
		'content'=>'required'
		);
}
