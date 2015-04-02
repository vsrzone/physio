<?php

/*
	Name:		Category
	Purpose:	Database class for Categories table

	History:	Created 02/04/2015 by buddhi ashan	 
*/


class Category extends Eloquent
{
	protected $guarded = array();

	public static $rules = array(
		'name'=>'required'
		);
}
