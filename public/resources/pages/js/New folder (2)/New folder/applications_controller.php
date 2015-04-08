<?php

	function getAllApplications($variables){
		$page = 1;
		if(isset($variables['page'])){
			$page = $variables['page'];
		}

		$applications = new Applications();	
		$items = $applications->getAll($page);
		$send = array();
		foreach ($items as $item) {
			array_push($send,array('id'=>$item['id'],'title'=>$item['title'],'active'=>$item['active']));
		}

		echo json_encode($send);
	}

	function getAllApplicationsWithVacancyTitle($variables){
		$page = 1;
		if(isset($variables['page'])){
			$page = $variables['page'];
		}

		$applications = new Applications();	
		$items = $applications->getAllWithVacancyTitle($page);
		$send = array();
		foreach ($items as $item) {
			array_push($send,array('id'=>$item['id'],'title'=>$item['title'],'sub_date'=>$item['sub_date'],'surname'=>$item['surname'],'othername'=>$item['othername']));
		}

		echo json_encode($send);
	}

	function getAllApplicationsCount(){
		$applications = new Applications();
		echo $applications->getAllCount();
	}

	function getActiveApplications($variables){
		$page = 1;
		if(isset($variables['page'])){
			$page = $variables['page'];
		}

		$applications = new Applications();
		echo json_encode($applications->getActive($page));
	}

	function getActiveApplicationsCount(){
		$applications = new Applications();
		echo $applications->getActiveCount();
	}

	function deleteApplicationsById($variables){
		$id = $variables['id'];
		$applications = new Applications();
		echo $applications->deleteById($id);
	}

	function addApplicationsRecord($variables)
	{
		foreach ($variables as $key => $value) {
			if(gettype($value) == 'array'){
				$variables[$key] = json_encode($value);
			}
		}

		$applications = new Applications();
		echo $applications->insert($variables);
	}

	function getApplicationsById($variables){
		$id = $variables['id'];

		$applications = new Applications();
		$items = $applications->getById($id);

		$items = $items[0];
		$send = array('id'=>$items['id'],'title'=>$items['title'],'intro'=>$items['intro'], 'body'=>$items['body']);

		echo json_encode($send);
	}

	function updateApplicationsRecord($variables){
		$id = $variables['id'];
		$update = $variables['update'];

		$applications = new Applications();
		echo $applications->update($id,$update);
	}
	function getAllApplicationDetails($variables){
		$page = 1;
		if(isset($variables['page'])){
			$page = $variables['page'];
			
			
		}
		$id = '';
		if(isset($variables['id'])){
			$id = $variables['id'];
		}

		$applications = new Applications();	
		$items = $applications->getAllAppDetails($page, $id);
		$send = array();
		foreach ($items as $item) {
			array_push($send,array('id'=>$item['id'],'vacancy_id'=>$item['vacancy_id'],'date'=>$item['date'],'surname'=>$item['surname'],'othername'=>$item['othername']));
		} 

		echo json_encode($send);
	}

	function getVacApplicationsCount(){
		$id = '';
		if(isset($variables['id'])){
			$id = $variables['id'];
		}

		$applications = new Applications();
		echo $applications->getVacAppDetailsCount($id)[0][0];
	}
?>
