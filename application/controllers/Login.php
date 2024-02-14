<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

//fungsi-fungsi untuk user admin============================================
	public function log_cek(){
		$this->session->sess_destroy();
		$this->load->view('hrd/login_hrd');
	}	

	public function validasi_admin(){ //validasi login
		$nama = $this->input->post('nama'); 
		$password = $this->input->post('password'); 
		$select='id';
		$where = array( 'nama' => $nama, 'password' => md5($password) ); 
		$cek = $this->M_login->cek_login($select,"admin",$where)->num_rows(); 
		if($cek > 0){
			$data_session = array( 'nama' => $nama, 'status' => "login_admin");
			$this->session->set_userdata($data_session);
			//echo "sukses";
			redirect(base_url("Admin/index"));
		}else{ 
			//echo "Username dan password salah !"; 
			redirect(base_url("Login/admin"));
			
		}
	}


public function validasi_pengguna(){ //validasi login
		$nama = $this->input->post('nama'); 
		$password = $this->input->post('password'); 
		$select='id';
		$where = array( 'nama' => $nama, 'password' => md5($password) ); 
		$cek = $this->M_login->cek_login($select,"hrd",$where)->num_rows(); 
		if($cek > 0){
			$data_session = array( 'nama' => $nama, 'status' => "login_hrd");
			$this->session->set_userdata($data_session);
			//echo "sukses";
			redirect(base_url("HRD/index"));
		}else{ 
			//echo "Username dan password salah !"; 
			redirect(base_url("Login/cek_log"));
			
		}
	}
//fungsi-fungsi untuk user mahasiswa ============================================

	public function admin(){
		$this->session->sess_destroy();
		$this->load->view('admin/login_admin');
	}



}

//end of file Login.php
//location : application\controllers\