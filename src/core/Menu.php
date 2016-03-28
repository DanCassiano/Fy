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

		public function del( $idMenu ){
			return $this->_del($idMenu);
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

		public function listaMenus( $status = 1, $ordem = " ASC " ){
			return $this->db->fetchAll('SELECT 
											id, 
											pagina, 
											publicado, 
											date_format( data_criacao, "%d-%m-%Y %H:%m:%s")as data_criacao,
											ordem
										FROM paginas 
										WHERE publicado = ?  
										ORDER BY ordem ' .$ordem ,array($status));
		}

		public function listaImagensMenu( $idMenu, $local){
			return $this->db->fetchAll('SELECT * FROM imagem inner join imagens_menu im on im.id_imagem = imagem.id WHERE local = ? AND im.id_menu = ?',array($local, $idMenu));
		}

		public function despublicar( $idMenu ){
			$sql = "UPDATE `paginas` SET `publicado` = 0 WHERE `id` = ? ";
			return $this->db->executeUpdate($sql, array( (int)$idMenu ));
		}

		public function publicar( $idMenu ){
			$sql = "UPDATE `paginas` SET `publicado` = 1 WHERE `id` = ? ";
			return $this->db->executeUpdate($sql, array( (int)$idMenu ));
		}

		public function subir( $idMenu ){
			$statement = $this->db->executeQuery('SELECT ordem FROM paginas WHERE id = ?', array( $idMenu ));
			$menuAtual = $statement->fetch();
			$odemMenu = $menuAtual['ordem'];
			
			
			$statement = $this->db->executeQuery('SELECT id, ordem FROM paginas WHERE ordem = ? ', array( $odemMenu -1 ));
			$menuAlterar = $statement->fetch();

			$this->db->update('paginas', array('ordem'=> $odemMenu -1 ), array('id'=> $idMenu));
			
			return $this->db->update('paginas', array('ordem'=> $menuAlterar['ordem'] + 1 ), array('id'=> $menuAlterar['id']));
		}

		public function descer( $idMenu ){
			$statement = $this->db->executeQuery('SELECT ordem FROM paginas WHERE id = ?', array( $idMenu ));
			$menuAtual = $statement->fetch();
			$odemMenu = $menuAtual['ordem'];
			
			
			$statement = $this->db->executeQuery('SELECT id, ordem FROM paginas WHERE ordem = ? ', array( $odemMenu +1 ));
			$menuAlterar = $statement->fetch();
			
			$this->db->update('paginas', array('ordem'=> $odemMenu + 1 ), array('id'=> $idMenu));
			
			return $this->db->update('paginas', array('ordem'=> $menuAlterar['ordem'] - 1 ), array('id'=> $menuAlterar['id']));
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
				"data_criacao"=> date("Y-m-d H:m:s") ));
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

		private function _del( $idMenu){
			return $this->db->delete('paginas',array('id'=> $idMenu));
		}
	}