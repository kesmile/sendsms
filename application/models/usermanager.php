<?php

class usermanager extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getUserId($name)
    {
        $this->db->select('*')->from('users')->where('username =', $name);
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }
    
    public function getUserForId($id)
    {
        $this->db->select('*')->from('users')->where('id =', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }
    public function getUsers()
    {
        $this->db->select('id, username,estado')->from('users');
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
    }
    
    public function setUser($data){
         $this->db->select('*')->from('users')->where('username =', $data['username']);
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return false;
        }else{
	    $this->db->insert('users',$data);
	    return true;
	}
	
    }
    public function updateUser($data,$id){
		  $this->db->where('id', $id);
		  $this->db->update('users', $data); 
        return true;
    }
    public function deleteUser($username){
		    $this->db->where('username', $username);
		    $this->db->delete('users');
	    return true;
    }
}
	
?>
