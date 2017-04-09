<?php
/**
* 
*/
class M_users extends CI_Model
{
	public $table = 'users';
    public $id 	  = 'id';
    public $order = 'DESC';
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function delete($id){
			$delete = $this->db->delete('users',array('id'=>$id));
			$delete = $this->db->delete('users_groups',array('user_id'=>$id));
			return $delete;
	}

	public function total_rows($q = NULL) {
	    $this->db->like('id', $q);
		$this->db->or_like('username', $q);
		$this->db->from($this->table);
	    return $this->db->count_all_results();
    }

    public  function get_limit_data($limit, $start = 0, $q = NULL) {
		         $this->db->order_by($this->id, $this->order);
		     	 $this->db->like('id', $q);
		         $this->db->or_like('username', $q);
		         $this->db->or_like('email', $q);
		         $this->db->or_like('last_name', $q);
		         $this->db->or_like('first_name', $q);
				$this->db->limit($limit, $start);
		        return $this->db->get($this->table)->result();
   }

   public function get_datauser(){
   	  return $this->db->get($this->table)->result();
   }

   public function get_groups($id){
   	 $sql ="SELECT groups.`name` FROM users_groups JOIN groups on groups.`id` = users_groups.`group_id` WHERE users_groups.`user_id` ='".$id."'";
   	 return $this->db->query($sql)->result();
   }

   
}