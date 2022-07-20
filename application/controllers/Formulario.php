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

		redirect(base_url() . 'index.php/formulario/index/');
	}

	public function get_dados_usuario()
	{
		$resultado = $this->usuarios->select('TB_USUARIOS');
		return $resultado;
	}



	public function exercicio2(){
		// 1) Crie um array
		
			$arr = array();
		
		// 2) Popule este array com 7 números

			for ($i=0; $i < 7; $i++) { 
				$arr[$i] = rand(0, 100);
			}

			// OU

			$arr = [
				0 => 13,
				1 => 2,
				2 => 3,
				3 => 45,
				4 => 5,
				5 => 6,
				6 => 7
			];


		// 3) Imprima o número da posição 3 do array

			echo "------------------------- Print exercício 3) ------------------------- </br>";
			echo $arr[3];
			echo "</br>";

		// 4) Crie uma variável com todas as posições do array no formato de string separado por vírgula

			$posicoes = '';
			foreach($arr as $i => $a){
				$posicoes .= $a.', ';
			}
			$posicoes = rtrim($posicoes, " ,");

			echo "-------------------------  Print exercício 4) ------------------------- </br>";
			echo $posicoes . "</br>";


		// 5) Crie um novo array a partir da variável no formato de string que foi criada e destrua o array anterior

			$arrNovo = array();
			$arrNovo = $arr;
			unset($arr);

			echo "-------------------------  Print exercício 5) ------------------------- </br>";
			echo "Está setada a variavel anterior: ";
			echo (isset($arr))? 'True':'False';
			echo "</br>";

		// 6) Crie uma condição para verificar se existe o valor 14 no array
			$msg = "Não existe o valor!";
			if(in_array(14, $arrNovo)){
				$msg = "Existe o valor!";
			}

			echo "-------------------------  Print exercício 6) ------------------------- </br>";
			echo $msg;
			echo "</br>";

		// 7) Faça uma busca em cada posição. Se o número da posição atual for menor que o da posição anterior (valor anterior que não foi excluído do array ainda), exclua esta posição

			echo "-------------------------  Print exercício 7) ------------------------- </br>";
			echo "Array antes do tratamento: ";
			echo "<pre>";var_dump($arrNovo);
			for ($i=1; $i < count($arrNovo) ; $i++) { 
				if($arrNovo[$i] < $arrNovo[$i - 1]){
					unset($arrNovo[$i-1]);
				}
			}
			echo "Array após o tratamento: ";
			echo "<pre>";var_dump($arrNovo);

		// 8) Remova a última posição deste array

			echo "-------------------------  Print exercício 8) ------------------------- </br>";
			array_pop($arrNovo);
			echo "<pre>";var_dump($arrNovo);	

		// 9) Conte quantos elementos tem neste array

			echo "-------------------------  Print exercício 9) ------------------------- </br>";
			echo "O array tem ".count($arrNovo). " elementos";
			echo "</br>";

		// 10) Inverta as posições deste array

			echo "-------------------------  Print exercício 10) ------------------------- </br>";
			$arrNovo = array_reverse($arrNovo);
			echo "Array invertido: ";
			echo "<pre>";var_dump($arrNovo);	
	}
}
