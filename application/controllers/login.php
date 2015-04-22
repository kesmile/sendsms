<?php 

class login extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('usermanager');
	    $this->load->helper('url');
	    $this->load->database('default');
	    $this->load->library( 'session' );
	    $this->load->library( 'MY_Session' );
	    $this->load->library( 'encrypt' );
	    $this->load->helper('form');
	    $this->load->library('form_validation');
	}
	public function index(){
		$value = $this->session->userdata('nombre');
		$data['nombre'] = $value;
		if($value){
			redirect('panel');
		}
		
		$this->form_validation->set_rules('username', 'Usuario', 'required');
		$this->form_validation->set_rules('pass', 'Contraseña', 'required');
		
		if ($this->form_validation->run() == true){
			$name = $this->input->post('username');
			$pass = $this->encrypt->sha1($this->input->post('pass'));
			$value = $this->usermanager->getUserId($name);
			if($value){
				if($pass == $value[0]->password || $value[0]->estado == 1){
					$this->session->set_userdata('nombre',$name);
					$this->session->set_userdata('user_id',$value[0]->id);
					redirect('panel');
				}else{
					$msj = "login fallido";
					$this->session->sess_destroy();
				}
			}else{
				$msj = "usuario no encontrado";
			}
		}else{
			$msj = "";
		}
		$data['mensaje'] = $msj;
		$this->load->view('userview/login',$data);
	}
	public function register(){
		//redirect('panel');
		$this->form_validation->set_rules('username', 'Usuario', 'required');
		$this->form_validation->set_rules('pass', 'Contraseña', 'required');
		$this->form_validation->set_rules('pass2', 'Contraseña', 'required');
		if ($this->form_validation->run() == true){
			$name = $this->input->post('username');
			$pass = $this->input->post('pass');
			$pass2 = $this->input->post('pass2');
			if($pass == $pass2){
				$value = array();
				$value['username'] = $name;
				$value['password'] = $this->encrypt->sha1($this->input->post('pass'));
				if($this->usermanager->setUser($value)){
					$this->session->set_userdata('nombre',$name);
					redirect('panel');
				}else{
					$msj = "el usuario ya existe";
				}
			}else{
			    $msj = "login fallido";
			}
			
		}
		
		$this->load->view('userview/register');
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
