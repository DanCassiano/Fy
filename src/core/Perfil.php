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
	}