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
			return $this->add($dados);
		}

		public function edit( $dados ){
			return $this->update( $dados );
		}

		private function add( $dados ){
			
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