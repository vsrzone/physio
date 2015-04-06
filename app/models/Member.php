<?php

class Member extends Eloquent
{

	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'nic' => 'required',
		'concil_registration_no' => 'required',
		'sex' => 'required',
		'district' => 'required',
		'tp1' => 'required',
		'created_by' => 'required'
		);
}