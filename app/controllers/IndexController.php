<?php

class IndexController extends BaseController{

	public function __construct(){
		$this->beforeFilter('csrf', array('on'=>'post'));
	}

}