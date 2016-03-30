<?php 

	namespace Core;

	/**
	* Departamento
	*/
	class Departamento
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

		public function vincularContato( $idDepartamento, $idContato ){
			return $this->__vinculaContato($idDepartamento, $idContato);
		}

		private function __vinculaContato( $idDepartamento, $idContato){
			return $this->db->insert( 'contatos_departamento', 
				array("id_departamento"=> $idDepartamento,"id_contato"=>$idContato));
		}

		private function _add( $dados ){
			return $this->db->insert( 'departamentos', array("departamento"=>$dados['departamento'],"bloqueado"=>$dados['bloqueado']));
		}

		private function _edit( $dados ){
			
			foreach ( $dados as $key => $value )
				$places[] = $key . ' = :' . $key;

				$places = implode(', ', $places);
				$sql = "UPDATE departamentos SET {$places} WHERE id = :id"; 
			return $this->db->executeUpdate($sql, $dados );
		}
	}