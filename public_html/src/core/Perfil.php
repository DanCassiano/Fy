<?php 
	namespace Core;
	/**
	* 
	*/
	class Perfil
	{
		private $db;

		function __construct( $db )
		{
			$this->db = $db;
		}

		public function listPerfilt( $bloqueado = "N"){
			return $this->db->fetchAll('SELECT * FROM perfil WHERE bloqueado = ?',array($bloqueado));
		}

		public function getPerfil( $idPefil ){
			$statement = $this->db->executeQuery('SELECT * FROM perfil WHERE id = ?',array($idPefil));
			return $statement->fetch();
		}

		public function add( $dados ){
			return $this->db->insert('perfil', $dados);
		}

		public function edit( $dados ){
			return $this->db->update('perfil', $dados, array('id'=> $dados['id']));
		}

	}