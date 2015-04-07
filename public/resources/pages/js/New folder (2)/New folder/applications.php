<?php
//applications and events
require_once('medoo.min.php');

Class Applications{
	var $table = 'applications';

	var $database;

	var $pagination_count = pagination_count;

	public function __construct( $database = "dnname" ){
		$this->database = new medoo();
	}

	public function get($variable){
		return $this->$variable;	
	}
	
	public function set($variable,$value){
		$this->$variable = $value;
	}

	public function insert($var_array){
		return $this->database->insert($this->table,$var_array);
	}

	public function update($id,$var_array){
		return $this->database->update($this->table, $var_array, array('id'=>$id));
	}

	public function deleteById($id){
		return $this->database->delete($this->table, array('id'=>$id));
	}

	public function getById($id){
		return $this->database->query("SELECT * FROM $this->table WHERE `id` = $id")->fetchAll();
	}

	public function getAll($page){
		$pg_start = ($page-1) * $this->pagination_count;
		$pg_end = $this->pagination_count;

		return $result = $this->database->query("SELECT * FROM $this->table ORDER BY `date` DESC LIMIT $pg_start,$pg_end")->fetchAll();
	}

	public function getAllWithVacancyTitle($page){
		$pg_start = ($page-1) * $this->pagination_count;
		$pg_end = $this->pagination_count;

		return $result = $this->database->query("SELECT a.`id` as id,v.`title` as title,a.`date` as sub_date,a.`surname` as surname,a.`othername` as othername FROM $this->table a,`vacancies` v WHERE a.`vacancy_id` = v.`id` ORDER BY a.`date` DESC LIMIT $pg_start,$pg_end")->fetchAll();
	}

	public function getAllCount(){
		return $count = $this->database->count($this->table, array());
	}

	public function getActive($page){
		$pg_start = ($page-1) * $this->pagination_count;
		$pg_end = $this->pagination_count;
		return $result = $this->database->query("SELECT * FROM $this->table WHERE `active` = 1 ORDER BY `date` DESC LIMIT $pg_start,$pg_end")->fetchAll();
	}

	public function getActiveCount(){
		return $count = $this->database->count($this->table, array('active' => 1));
	}
	public function getAllAppDetails($page, $id){
		$pg_start = ($page-1) * $this->pagination_count;
		$pg_end = $this->pagination_count;
		if ($id == '') {
			return $result = $this->database->query("SELECT * FROM $this->table ORDER BY `date` DESC LIMIT $pg_start,$pg_end")->fetchAll();
		}
		return $result = $this->database->query("SELECT * FROM $this->table WHERE `vacancy_id`=$id ORDER BY `date` DESC LIMIT $pg_start,$pg_end")->fetchAll();
	}
	public function getVacAppDetailsCount($id){
		
		if ($id == '') {
			return $result = $this->database->query("SELECT COUNT(*) FROM $this->table ORDER BY `date` DESC")->fetchAll();
		}
		return $result = $this->database->query("SELECT COUNT(*) FROM $this->table WHERE `vacancy_id`=$id ORDER BY `date` DESC")->fetchAll();
	}
}

?>