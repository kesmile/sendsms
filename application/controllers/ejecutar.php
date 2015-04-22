<?php
 
class ejecutar extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->database('default');
	    $this->load->library( 'session' );
	    $this->load->library( 'MY_Session' );
	    $this->load->library('Myfunction');
	    $this->load->helper('form');
	    $this->load->library('form_validation');
	    $this->load->model('panel_model');
	    $this->load->library('twilio');
	}
        public function valid(){
 		$data['alert'] = false;
		$data['error'] = null;
		$this->form_validation->set_rules('numbers', 'Numeros', 'required');
		$this->form_validation->set_rules('mensaje', 'Mensajes', 'required');
		if ($this->form_validation->run() == true){
                        $variables = array('{nombre}', '{monto}','{otro}');
			$numeros = $this->input->post('numbers');
			$mensajes = $this->input->post('mensaje');
			$tarea = $this->input->post('mycheck');
			$mensajes_ind = array();
		    if($tarea == false){
			$array = explode(";", $numeros);
                        
							//$sleep = 0;
						$enviados = $total = count($array);
						$ok = "";
						$fails ="";
						$sleep = 0;
						foreach($array as $row){
							$datos = explode(",",$row);
							if(isset($datos[1]) || isset($datos[2]) || isset($datos[3])){	
								$valores = array((isset($datos[1]))? $datos[1] : "",(isset($datos[2]))? $datos[2] : "",(isset($datos[3]))? $datos[3] : "");
								$msj = str_replace($variables, $valores , $mensajes);
							}else{
								$msj = $mensajes;
							}
							
							//echo $msj;
                                                        //nombre: {nombre}, monto: Q.{monto}, otro: {otro} y esto es una prueba
							if(strlen($datos[0]) == 8){
								//$curl = curl_init();
								if($this->myfunction->validacionTel($datos[0])){
									//$url = 'http://192.168.87.117/sendsms/receiver.php?phone=' . $datos[0]	 . '&msg=' . urlencode( $msj );
								//exec("curl '". $url ."'");
								echo $datos[0];
                                $twilio = $this->twilio->getClass("ACb09c8c273987d8656a736ad793b7586c","bc1f530904eea30c972584a5f7e2ab5c");
                                $twilio->account
                                       ->messages
                                       ->sendMessage("+17543336703", "+502".$datos[0], $msj);
								//echo $url;
								}
								$sleep++;
								if($sleep >= 25){
									sleep(1);
									$sleep = 0;
								}
							$this->panel_model->setTelefono(array("usuario" => $datos[0]));
							$mensajes_ind[] = array('telefono' => $datos[0], 'mensaje' => $msj, 'estado' => 'enviado');
							$ok .= $row . ",";
							}else{
								$fails .= $row . ",";
								$mensajes_ind[] = array('telefono' => $datos[0], 'mensaje' => $msj, 'estado' => 'fallido');
								$enviados--;
							}
                                                        //break;
						}
						$numeros = substr($ok, 0, -1);
						$fails = substr($fails, 0, -1);
					
						$data['alert'] = true;
						$params = array("numbers" => $numeros,
								"mensaje" => $mensajes,
								"total" => $total,
								"fails" => $fails,
								"enviados" => $enviados);
						if($this->session->userdata('user_id')){
							$params["user_id"] =  $this->session->userdata('user_id');
						}else{
							$params["user_id"] = '1';
						}
						 $this->panel_model->setTotalMsj($total,$params["user_id"]);
						$lastid = $this->panel_model->setMensajes($params);
						foreach($mensajes_ind as $rowmsj){
							$this->panel_model->setMensajesInd(array('telefono'=> $rowmsj['telefono'], 'mensaje' => $rowmsj['mensaje'],
											      'estado' => $rowmsj['estado'], 'mensajes_id' => $lastid));
						}
						
			}else{
				/*
				 *	tareas: id, fecha, hora, numeros, mensaje
				 */
				$fecha = $this->input->post('fecha');
				$hora = $this->input->post('hora');
				$edit_id = $this->input->post('edit_id');
				if($fecha && $hora){
					$params['fecha'] = $fecha;
					$params['hora'] = $hora;
					$params['numeros'] = $numeros;
					$params['mensaje'] = $mensajes;
					$params['estado'] = "pendiente";
					if(!$edit_id){
							$this->panel_model->setTareas($params);
							echo "save";
						}else{
							$this->panel_model->updateTarea($params,$edit_id);
							echo "update";
						}
					
					echo true;
				}else{
					echo 'error';
				}
			}
		}else{
			echo "error";
		}
	}
        public function cron(){
		date_default_timezone_set("America/Guatemala");
		$date = date('Y-m-d');
		$time = date ( "H:i:s" , time() );
		$time = substr($time,0,2);
		$url = "http://200.35.162.27/sendsms/index.php/ejecutar/valid";
		$tareas = $this->panel_model->getTareas(array('fecha' => $date, 'hora' => $time));
		echo $time;
		foreach($tareas as $tarea){
			$data = array("numbers" => $tarea->numeros, "mensaje" => $tarea->mensaje);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
			$response = curl_exec($ch);
			curl_close($ch);
			$this->panel_model->deleteTareas($tarea->id);
			sleep(1);
			echo $tarea->numeros . "</br>";
		}
		/*$dato = '43748888;43748888;43748888;';
		$filtro = explode(";", $dato);
		$fil2 = explode(",", $filtro[0]);
		var_dump($fil2);*/
	}
	public function get(){
		$datos = $this->panel_model->getTels();
		echo json_encode($datos);
	}
	public function telstatus(){
		$tel =  $this->input->get('telefono');
		if($tel){
			$datos = $this->panel_model->getTelid($tel);
			if($datos){
				echo json_encode(array('status' => 'true'));
			}else{
				echo json_encode(array('status' => 'false'));
			}
			
			return true;
		}
		echo 'error';
		
	}
	public function set(){
		$mensaje = $this->input->get('mensaje');
		$telefono = $this->input->get('telefono');
		
		$datos['telefono'] = $telefono;
		$datos['mensaje'] = urldecode($mensaje);
		$datos['flag'] = 1;
		
		$this->panel_model->setNotify($datos);
		
		$params["user_id"] = 1;
		$this->panel_model->setTotalMsj(1,$params["user_id"]);
	}
	public function read($id){
		if($id){
			$data['flag'] = 0;
			$this->panel_model->updateNotify($data,$id);
			redirect('/panel/notify');
		}
		echo 'error';
	}
	public function test(){
		$tel = $this->input->get('telefono');
		$url = "http://200.35.162.27/sendsms/index.php/ejecutar/exec";
		$salida = shell_exec("curl '". $url ."'");
		echo $salida;
	}
	public function exec(){
		echo "funciona ok";
	}
}

?>
