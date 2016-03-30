<?php 
	
	namespace Core;
	/**
	* Publicidade
	*/
	class Publicidade
	{
		private $db;

		function __construct( $db )
		{
			$this->db = $db;
		}


		public function listPublicidades( $bloqueado = 'N') {
			return $this->db->fetchAll("SELECT * FROM publicidade WHERE bloqueado = ?", array($bloqueado));
		}
	}