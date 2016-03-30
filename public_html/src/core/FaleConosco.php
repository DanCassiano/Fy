<?php 

	namespace Core;

	/**
	* FaleConosco
	*/
	class FaleConosco
	{
		
		// vars 
			private $db;

		function __construct( $db )
		{
			$this->db = $db;
		}

		public function temMensagens(){
			$statement = $this->db->executeQuery('SELECT COUNT(*) as qtd FROM fale_conosco WHERE lido = 0');
			$r = $statement->fetch();
			return $r['qtd'];
		}

		public function getMensagens( $lida = 0 ){
			return $this->db->fetchAll('SELECT * FROM fale_conosco WHERE lido = ?',array($lida));
		}

		public function getMensagem( $idFaleConosco ){
			$statement = $this->db->executeQuery('SELECT 
													f.`id`,
													f.`asunto`,
	 												f.`id`, 
	 												DATE_FORMAT( f.`data_criacao`, "%h:%m:%s %d-%m-%Y ") AS data_criacao ,
	 												f.`email`, 
	 												f.`msg`, 
	 												f.`id_departamento`
	 											FROM fale_conosco f WHERE f.id = ?',array($idFaleConosco));
			$r = $statement->fetch();
			return $r;
		}

		public function marcar( $idFaleConosco, $lida ){
			return $this->db->update('fale_conosco', array("lido"=> $lida, "data_leitura"=> date("Y-m-d H:m:s")), array('id'=> $idFaleConosco));
		}

		public function add( $dados ){
			return $this->db->insert('fale_conosco', $dados );
		}
	}