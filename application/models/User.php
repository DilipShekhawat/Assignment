<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class user extends CI_Model{

	function __construct() {
        $this->userTbl = 'students';
    }

     /*
     * Insert user information
     */
    public function insert($data = array()) {
    	if(!empty($data)){
    		$insert = $this->db->insert($this->userTbl, $data);
    		if($insert){
	            return $this->db->insert_id();
	        }else{
	            return false;
	        }
    	}
    }

    public function delete($id){
    
    $val = array(
      'student_id' => $id
    );
    return $this->db->delete('students', $val);
    }
    
    public function getAll(){
        $this->db->select("*");
        $this->db->from("students");
        $query = $this->db->get();        
        return $query->result();
    }
    
    public function update($userid, $data = array()){
        if(!empty($data)){
            $this->db->where('student_id', $userid);
            $this->db->update($this->userTbl, $data);
            return $userid;
        }
    }
    
}