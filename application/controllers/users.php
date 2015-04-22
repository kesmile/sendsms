<?php 
/*
 *	https://www.youtube.com/watch?v=8pNIVWUyJDg
 sendmesseger http://wpavanzado.com/3-plugins-google-analytics-wordpress/
 */
class users extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->database('default');
	    $this->load->library( 'session' );
	    $this->load->library( 'MY_Session' );
	    $this->load->library('Myfunction');
	    $this->load->library( 'encrypt' );
	    $this->load->helper('form');
	    $this->load->library('form_validation');
	    $this->load->model('panel_model');
	    $this->load->model('usermanager');
	}
	public function index(){
		$value = $this->session->userdata('nombre');
		$header['user_id'] = $this->session->userdata('user_id');
		if(!$value && $header['user_id'] > 1){
			redirect('login');
		}
		$header['user'] = $value;
		$header['total'] = $this->panel_model->getTotalMsj($header['user_id']);
		$header['total_msj'] = $this->panel_model->getNotifyActive();
		
		
		$data['users'] = $this->usermanager->getUsers();
		$this->load->view('panel/header',$header);
		$this->load->view('panel/users/users',$data);
		$this->load->view('panel/footer');
		
	}
	public function add(){
		$value = $this->session->userdata('nombre');
		$header['user_id'] = $this->session->userdata('user_id');
		if(!$value && $header['user_id'] > 1){
			redirect('login');
		}
		$header['user'] = $value;
		$header['total'] = $this->panel_model->getTotalMsj($header['user_id']);
		$header['total_msj'] = $this->panel_model->getNotifyActive();
		$data['username'] = null;
		$this->form_validation->set_rules('username', 'Usuario', 'required');
		$this->form_validation->set_rules('pass', 'Contraseña', 'required');
		$this->form_validation->set_rules('pass2', 'Contraseña comfirmacion', 'required');
		if ($this->form_validation->run() == true){
			$datos['username'] = $this->input->post('username');
			$pass = $this->input->post('pass');
			$confir_pass = $this->input->post('pass2');
			if($pass == $confir_pass){
				$datos['password'] = $this->encrypt->sha1($pass);
				$datos['estado'] = 1;
					if($this->usermanager->setUser($datos))
						redirect('users');
					else
						echo "Error usuario ya existe!";
			}else{
				echo "Confirmacion de password incorrecta";
			}
		}
		$this->load->view('panel/header',$header);
		$this->load->view('panel/users/form',$data);
		$this->load->view('panel/footer');
	}
	public function update($id){
		$value = $this->session->userdata('nombre');
		$header['user_id'] = $this->session->userdata('user_id');
		if(!$value && $header['user_id'] > 1){
			redirect('login');
		}
		$header['user'] = $value;
		$header['total'] = $this->panel_model->getTotalMsj($header['user_id']);
		$header['total_msj'] = $this->panel_model->getNotifyActive();
		$data['id'] = $id;
		$data['ok'] = false;
		$data['msj'] = null;
		if($id){
			$result = $this->usermanager->getUserForId($id);
			if($id){
				$data['username'] = $result[0]->username;
				$data['estado'] = $result[0]->estado;
			}
		}
		$this->form_validation->set_rules('username', 'Usuario', 'required');
		if ($this->form_validation->run() == true){
			$datos['username'] = $this->input->post('username');
			$pass = $this->input->post('pass');
			$confir_pass = $this->input->post('pass2');
			$estado = $this->input->post('estado');
			//echo $pass . "-" . $confir_pass;
			if($estado){
				$datos['estado'] = 1;
			}else{
				if($header['user_id'] > 1){
				$datos['estado'] = 0;
				}
			}
			$this->usermanager->updateUser($datos,$id);
		     if($pass && $confir_pass){
			if($pass == $confir_pass){
				$datos['password'] = $this->encrypt->sha1($pass);					
					$this->usermanager->updateUser($datos,$id);
					//redirect('users');
					$data['ok'] = true;
			}else{
				$data['msj'] = "Confirmacion de password incorrecta";
			}
			//
		    }else{
		    	$data['ok'] = true;
		    }
		
		}
		$this->load->view('panel/header',$header);
		$this->load->view('panel/users/update',$data);
		$this->load->view('panel/footer');
	}
	public function report(){
		$value = $this->session->userdata('nombre');
		$header['user_id'] = $this->session->userdata('user_id');
		if(!$value && $header['user_id'] > 1){
			redirect('login');
		}
		$header['user'] = $value;
		$header['total'] = $this->panel_model->getTotalMsj($header['user_id']);
		$header['total_msj'] = $this->panel_model->getNotifyActive();
		
		$data['meses'] = array(0 => array('value' => '01', 'name' => 'Enero'),
				       1 => array('value' => '02', 'name' => 'Febrero'),
				       2 => array('value' => '03', 'name' => 'Marzo'),
				       3 => array('value' => '04', 'name' => 'Abril'),
				       4 => array('value' => '05', 'name' => 'Mayo'),
				       5 => array('value' => '06', 'name' => 'Junio'),
				       6 => array('value' => '07', 'name' => 'Julio'),
				       7 => array('value' => '08', 'name' => 'Agosto'),
				       8 => array('value' => '09', 'name' => 'Septiembre'),
				       9 => array('value' => '10', 'name' => 'Octubre'),
				       10 => array('value' => '11', 'name' => 'Noviembre'),
				       11 => array('value' => '12', 'name' => 'Diciembre'));
		$data['anios'] = array(0 => array('value' => '2014'),
				       1 => array('value' => '2015'),
				       2 => array('value' => '2016'),
				       3 => array('value' => '2017'),
				       4 => array('value' => '2018'));
		$data['select_mes'] = $this->input->get('mes');
		$data['select_anio'] = $this->input->get('anio');
		$data['msj'] = null;
		$data['users'] = null;
		$data['total_users'] = null;
		$date = date('m-Y');
		
		if($data['select_mes'] == null && $data['select_anio'] != null){
			$date = $data['select_anio'];
			$data['total_users'] = $this->panel_model->getTotalAllMsj($date);
		}else if($data['select_mes'] != null && $data['select_anio'] != null){
			 $date =  $data['select_mes']."-". $data['select_anio'];
			$data['users'] = $this->panel_model->getTotalUsersMsj($date);
		}
		
		$this->load->view('panel/header',$header);
		$this->load->view('panel/users/detalleusers',$data);
		$this->load->view('panel/footer');
		
	}
}
