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

		public function login( $email, $senha ){
			return $this->_login($email, $senha);
		}

		public function novo( $dados ){
			return $this->_add($dados);
		}

		public function edit( $dados ){
			return $this->update( $dados );
		}

		public function setImagem( $idUser, $imagem ){
			$sql = "UPDATE `usuario`
						SET
							imagem= ?
							WHERE `id` = ".$idUser;
			return $this->db->executeUpdate($sql, array( $imagem ));
		}

		private function _login( $email, $senha ){
			return $this->db->fetchAll('SELECT `id`,`usuario`.`nome`, imagem FROM `usuario` WHERE email = ? AND senha = ? AND ativo = 1',array($email, $senha));
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
			$sql = "UPDATE `usuario`
						SET
							`id` = ?,
							`nome` = ?,
							`login` = ?,
							`publicado` = ?
							WHERE `id` = ".$dados['id'];
			return $this->db->executeUpdate($sql, array( (int)$dados['id'],$dados['nome'], $dados['link'], $dados['status'] ));
		}
	}