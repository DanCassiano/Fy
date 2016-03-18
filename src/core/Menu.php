<?php 
	namespace Core;
	/**
	* 
	*/
	class Menu
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

		public function addConteudo($idPagina, $conteudo ){
			$this->_addConteudo($idPagina, $conteudo);
		}

		public function updateConteudo( $idConteudo, $conteudo ){
			return $this->_updateConteudo($idConteudo, $conteudo);
		}

		private function _addConteudo( $idPagina, $conteudo ){
			return $this->db->insert( 'conteudo', array("conteudo"=>$conteudo,"id_pagina"=>$idPagina));
		}

		private function _updateConteudo( $idConteudo, $conteudo ){
			$sql = "UPDATE `conteudo` SET `conteudo` = ? WHERE `id` = ?";
			return $this->db->executeUpdate($sql, array( $conteudo,(int)$idConteudo));
		}

		private function _add( $dados ){
			
			return $this->db->insert( 'paginas', array(
				"pagina"=>$dados['nome'],
				"link"=>$dados['link'],
				"publicado"=>$dados['status'],
				"data_criacao"=>"NOW()"));
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