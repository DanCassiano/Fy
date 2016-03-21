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

		public function registraImagemMenu( $idImagem, $idMenu, $local ){
			return $this->_registraImagem($idImagem, $idMenu, $local);
		}

		public function listaImagensMenu( $idMenu, $local){
			return $this->db->fetchAll('SELECT * FROM imagem inner join imagens_menu im on im.id_imagem = imagem.id WHERE local = ? AND im.id_menu = ?',array($local, $idMenu));
		}

		private function _registraImagem( $idImagem, $idMenu, $local ){
			return $this->db->insert( 'imagens_menu', array("id_imagem"=> $idImagem, "id_menu"=> $idMenu, "local"=> $local));
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