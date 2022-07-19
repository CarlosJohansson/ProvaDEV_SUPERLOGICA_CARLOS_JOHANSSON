<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formulario extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Usuarios_model', 'usuarios');
    }

	public function index()
	{	
		$tabela = $this->get_dados_usuario();

		$this->load->view('formulario', ['usuarios' => $tabela]);
	}

	public function post_formulario(){
		$post = $this->input->post();

		$campos = [
			'NOME_COMPLETO' => $post['name'],
			'CEP' => str_replace('-', '', $post['zipCode']),
			'EMAIL' => $post['email'],
			'SENHA' => $post['password'],
			'USUARIO' => $post['userName']
		];

		$resultado = $this->usuarios->insert('TB_USUARIOS', $campos);

		redirect(base_url() . 'index.php/formulario/index/'.$resultado);
	}

	public function get_dados_usuario()
	{
		$resultado = $this->usuarios->select('TB_USUARIOS');
		return $resultado;
	}
}
