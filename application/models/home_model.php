<?php
class home_model extends CI_Model{

  public function getList(){
    $data = array(
      array("id" => 1, "name" => "Chu Kim Thang", "age" => 22),
      array("id" => 2, "name" => "Pham Ngoc Son", "age" => 21 ),
      array("id" => 3, "name" => "Nguyen Manh Quang", "age" => 23)
    );
    return $data;
  }
  
  public function getCIProduct()
  {
  	$this->load->database();
  	$query = $this->db->query("select * from CI_Products");
  	return $query->result_array();
  }
  public function insertDB($dataInsert)
  {
    $this->load->database();
    $this->db->insert('CI_Products',$dataInsert);
    return $this->db->insert_id(); 
  }
}

?>