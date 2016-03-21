<?php 
	namespace Core;
	/**
	* 
	*/
	class Imagem
	{
		private $db;

		function __construct( $db )
		{
			$this->db = $db;
		}

		public function add( $imagem, $dir ){
			return $this->_add( $imagem, $dir);
		}

		private function _add( $imagem, $dir ){
			$this->db->insert( 'imagem', array("imagem"=> $imagem, "dir"=> $dir));
			return $this->db->lastInsertId(); 
		}
	}