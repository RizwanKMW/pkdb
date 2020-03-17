<?php
class upload extends CI_Model{
	function __construct(){
		$this->load->database();
	}

	function getData($sel,$from){
		$this->db->select($sel);
		$this->db->from($from);
		$query = $this->db->get();
		return $query->result_array();
	}

	function insert($tabel, $data_insert){
		$res = $this->db->insert($tabel, $data_insert); 
		return $res;
	}

	function insertAllTags($tags,$id){
	$tagsare=explode(",",$tags);//string to array
    $data=array();
    $this->db->query(
      "DELETE FROM `tags` WHERE `post_id`=$id"
    );

    foreach ($tagsare as $key) {
       $newarray=array(
        'post_id' =>$id ,
        'tag' =>$key
      );
       array_push($data, $newarray);
    }
    $this->db->insert_batch('tags', $data);

	}
}