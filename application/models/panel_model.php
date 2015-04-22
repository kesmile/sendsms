<?php

class panel_model extends CI_Model
{
      public function __construct()
      {
        parent::__construct();
	    $this->load->library( 'session' );
	    $this->load->library( 'MY_Session' );
      }
      public function getMensajes($data){
	 $this->db->select('mensajes.*, users.username')->from('mensajes');
	 $this->db->join('users', 'mensajes.user_id = users.id');
	 $this->db->where('date(fecha) >= ', $data['fecha_init']);
	 $this->db->where('date(fecha) <= ', $data['fecha_end']);
	 $this->db->order_by("fecha", "desc");
	 if(isset($data['user_id'])){
	    $this->db->where('user_id = ', $data['user_id']);
	 }
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
      }
      
      public function setMensajes($data){
	$this->db->insert('mensajes',$data);
	return $this->db->insert_id();
      }
      public function setTelefono($data){
	    $this->db->select('*')->from('telefonos');
	    $this->db->where('usuario = ', $data['usuario']);
	    $query = $this->db->get();
	    if($query->num_rows() > 0 )
	    {
		return false;
	    }
	$this->db->insert('telefonos',$data);
	    return true;
      }
      /*
      *		modelo de notificaciones
      */
      public function updateNotify($data,$id){
      	$this->db->where('id',$id);
	$this->db->update('notify',$data);
	return true;
      }
      public function setNotify($data){
	$this->db->insert('notify',$data);
	return $this->db->insert_id();
      }
      public function getNotify(){

	 $this->db->select("*")->from('notify');
	 $this->db->order_by("fecha", "desc"); 
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
      }
      public function getNotifyActive(){
	 $this->db->select('count(id) as total')->from('notify');
	 $this->db->where('flag = ', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
      }
      public function getLastValue(){
	    $this->db->select('*')->from('telefonos');
	    $this->db->where('usuario = ', $data['usuario']);
	    $query = $this->db->get();
	    if($query->num_rows() > 0 )
	    {
		return false;
	    }
      }
      public function setTotalMsj($value,$id){
	    $date = date('m-Y');
	    $this->db->select('*')->from('enviados');
	    $this->db->where('fecha = ', $date);
	    $this->db->where('id_user = ', $id);
	    $query = $this->db->get();
	    if($query->num_rows() > 0 )
	    {
		  
		  $result = $query->result();
		  $data['total'] = $value + $result[0]->total;
		  $this->db->where('id', $result[0]->id);
		  $this->db->update('enviados', $data);
	    }else{
		  $data['id_user'] = $id;
		  $data['fecha'] = date('m-Y');
		  $data['total'] = $value;
		  $this->db->insert('enviados',$data);
		  
	    } 
	    return true;
      }
      public function getTotalMsj($id){
	    $this->db->select('*')->from('enviados');
	    $this->db->where('id_user = ', $id);
	    $this->db->where('fecha = ', date('m-Y'));
	    $query = $this->db->get();
	    if($query->num_rows() > 0 )
	    {
		  return $query->result();
	    }
      }
      
      public function getTotalUsersMsj($date){
	    //date('m-Y')
	    $this->db->select('enviados.* , users.username')->from('enviados')->join('users','enviados.id_user = users.id');
	    $this->db->where('fecha = ', $date);
	    $query = $this->db->get();
	    if($query->num_rows() > 0 )
	    {
		  return $query->result();
	    }
      }
      public function getTotalAllMsj($date){
	    //date('m-Y')
	    $this->db->select('enviados.* , users.username')->from('enviados')->join('users','enviados.id_user = users.id');
	    $this->db->like('fecha', $date, 'before');
	    $this->db->order_by("fecha", "asc"); 
	    $query = $this->db->get();
	    if($query->num_rows() > 0 )
	    {
		  return $query->result();
	    }
      }
      /*
       *	funciones para sugerencias
       */
      public function setSugerencias($data){
	    $this->db->insert('sugerencias',$data);
	    return true;
      }
      public function getSugerencias(){
	    $this->db->select('*')->from('sugerencias');
	    $query = $this->db->get();
	    if($query->num_rows() > 0 )
	    {
		  return $query->result();
	    }
      }
      /*
       *	Tareas cron
       */
      public function deleteTareas($id){
	    $this->db->where('id', $id);
	    $this->db->delete('tareas');
	    return true;
      }
      public function updateTarea($data,$id){
	    $this->db->where('id', $id);
	    $this->db->update('tareas',$data);
	    return true;
      }
      public function setTareas($data){
	    $this->db->insert('tareas',$data);
	    return true;
      }
      public function getTareas($data = array()){
         if(isset($data['fecha']) && isset($data['hora'])){
	    $this->db->where('fecha',$data['fecha']);
	    $this->db->where('hora',$data['hora']);
	 }
	 $this->db->select('*')->from('tareas');
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }else{
	    return false;
	}
      }
      public function getTarea($id){

	 $this->db->select('*')->from('tareas');
	 $this->db->where('id =', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
      }
      /*
       * mensajes individuales
       */
      public function setMensajesInd($data){
	$this->db->insert('mensajes_ind',$data);
	return $this->db->insert_id();
      }
      public function getMensajesInd($id){

	 $this->db->select('*')->from('mensajes_ind');
	 $this->db->where('mensajes_id =', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
      }
      /*
       *	numeros ingresados
       */
      public function getTels(){
         $this->db->select('*')->from('telefonos');
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return $query->result();
        }
      }
      public function getTelid($tel){
         $this->db->select('*')->from('telefonos');
	    $this->db->where('usuario =', $tel);
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            return true;
        }
	    return false;
      }
      /*
       *	Historial de mensajes
       */
      public function getHistory($tel){
         $this->db->select('telefono, mensaje, fecha')->from('notify');
	 $this->db->where('telefono = ', $tel);
	 
	 
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            $datos = $query->result();
        }
	$this->db->select('telefono, mensaje, fecha')->from('mensajes_ind');
        $this->db->where('telefono = ', $tel);
	 
        $query = $this->db->get();
        if($query->num_rows() > 0 )
        {
            $temp = $query->result();
	    foreach($temp as $row){
		  $datos[] = $row;
	    }
        }
	return $datos;
	
      }
}
	
?>
