<?php 

	namespace Core;

	/**
	* Contato
	*/
	class Contato
	{
		
		// var
			private $db;


		function __construct($db)
		{
			$this->db = $db;
		}

		public function add( $dados ){
			return $this->_add($dados);
		}

		public function edit( $dados ){
			return $this->_edit($dados);
		}

		public function del(){

		}

		private function _add( $dados ){
			$this->db->insert( 'contatos', array("contato"=>$dados['contato'],"nome"=>$dados['nome']));
			return $this->db->lastInsertId();
		}

		private function _edit( $dados ){
			
			foreach ( $dados as $key => $value )
				$places[] = $key . ' = :' . $key;

				$places = implode(', ', $places);
				$sql = "UPDATE contatos SET {$places} WHERE id = :id"; 
			return $this->db->executeUpdate($sql, $dados );
		}
	}