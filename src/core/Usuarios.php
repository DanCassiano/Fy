<?php 
	
	namespace Core;
	/**
	* 
	*/
	class Usuarios
	{
		
		private $db;

		function __construct( $db )
		{
			$this->db = $db;
		}

		public function novo( $dados ){
			return $this->_add($dados);
		}

		public function edit( $dados ){
			return $this->update( $dados );
		}

		private function _add( $dados ){
			return $this->db->insert( 'usuario', array(
				"nome"=>$dados['nome'],
				"senha"=> md5(md5($dados['senha'])) ,
				"email"=>$dados['email'],
				"ativo"=>$dados['ativo'],
				"data_cadastro"=>"NOW()"));
		}

		private function update( $dados ){
			$sql = "UPDATE `paginas`
						SET
							`id` = ?,
							`pagina` = ?,
							`link` = ?,
							`publicado` = ?
							WHERE `id` = ".$dados['id'];
			return $this->db->executeUpdate($sql, array( (int)$dados['id'],$dados['nome'], $dados['link'], $dados['status'] ));
		}
	}