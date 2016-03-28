<?php 
	use Doctrine\DBAL\Schema\Table;

if (!$schema->tablesExist('paginas')) {
	$paginas = new Table('paginas');
	
	$paginas->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$paginas->setPrimaryKey(array('id'));
	
	$paginas->addColumn('pagina', 'string', array('length' => 100));
	// $paginas->addUniqueIndex(array('username'));
	$paginas->addColumn('link', 'string', array('length' => 50));
	$paginas->addColumn('tipo', 'string', array('length' => 100));
	$paginas->addColumn('publicado', 'integer', array('default' => 1));
	$paginas->addColumn('data_criacao', 'datetime');
	$paginas->addColumn('ordem', 'integer');

	$schema->createTable($paginas);


	


    $app['db']->insert('paginas', array(
      'pagina' => 'Home',
      'tipo' => '',
      'data_criacao' => date("Y-m-d H:m:s"),
      'ordem' => 1,
    ));
}

if (!$schema->tablesExist('conteudo')) {
	$conteudo = new Table("conteudo");
	$conteudo->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$conteudo->setPrimaryKey(array('id'));
	
	$conteudo->addColumn('conteudo', 'text');
	$conteudo->addColumn('id_pagina', 'integer', array('unsigned' => true));
	$schema->createTable($conteudo);
}

$usuarioTable = "";
if (!$schema->tablesExist('usuario')) {


	$usuarioTable = new Table("usuario");

	$usuarioTable->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$usuarioTable->setPrimaryKey(array('id'));
	
	$usuarioTable->addColumn('nome', 'string',array("length"=> 255));
	$usuarioTable->addColumn('login', 'string',array("length"=> 40));
	$usuarioTable->addColumn('senha', 'string', array('length' => 50));
	$usuarioTable->addColumn('email', 'string', array('length' => 50));
	$usuarioTable->addColumn('ativo', 'integer');
	$usuarioTable->addColumn('imagem', 'string',array("length"=>200));
	$usuarioTable->addColumn('data_cadastro', 'datetime');

	$schema->createTable($usuarioTable);

	
	$app['db']->insert('usuario', array(
		'nome' => 'Jordan',
		'email'=> 'jordan@admin',
		'senha' => 'd9b1d7db4cd6e70935368a1efb10e377',
		'ativo' => 1,
		'data_cadastro'=> date('Y-m-d H:m:s')
	));
	$app['db']->insert('usuario', array(
		'nome' => 'Franklin',
		'email'=> 'franklin@admin',
		'senha' => 'd9b1d7db4cd6e70935368a1efb10e377',
		'ativo' => 1,
		'data_cadastro'=> date('Y-m-d H:m:s')
	));

}

$imagemTable = "";
if (!$schema->tablesExist('imagem')) {
	$imagemTable = new Table("imagem");

	$imagemTable->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$imagemTable->setPrimaryKey(array('id'));
	
	$imagemTable->addColumn('imagem', 'string',array("length"=> 50));
	$imagemTable->addColumn('dir', 'string',array("length"=> 50));
	$schema->createTable($imagemTable);

	if (!$schema->tablesExist('imagens_menu')) {

		$imagemMenu = new Table("imagens_menu");

		$imagemMenu->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
		$imagemMenu->setPrimaryKey(array('id'));
	
		$imagemMenu->addColumn('id_imagem', 'integer');
		$imagemMenu->addColumn('id_menu', 'integer');
		$schema->createTable($imagemMenu);
	}
}

if ($schema->tablesExist('imagem') &&!$schema->tablesExist('imagens_usuario')) {
		
		$imagensUsuario = new Table("imagens_usuario");

		$imagensUsuario->addColumn('id_imagem', 'integer');
		$imagensUsuario->addColumn('id_usuario', 'integer');
		// $imagensUsuario->addForeignKeyConstraint($imagemTable, array("id_imagem"), array("id"), array("onUpdate" => "CASCADE"));
		// $imagensUsuario->addForeignKeyConstraint($usuarioTable, array("id_usuario"), array("id"), array("onUpdate" => "CASCADE"));
		$schema->createTable($imagensUsuario);

}
if (!$schema->tablesExist('departamentos')) {

	$departamentos = new Table("departamentos");
	$departamentos->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$departamentos->setPrimaryKey(array('id'));

	$departamentos->addColumn('departamento', 'string',array("length"=>200));
	$departamentos->addColumn('bloqueado ', 'string',array('length'=>1, "default"=> 'N'));
	$schema->createTable($departamentos);

}

if (!$schema->tablesExist('contatos')) {

	$contatos = new Table("contatos");
	$contatos->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$contatos->setPrimaryKey(array('id'));

	$contatos->addColumn('contato', 'string',array("length"=>100));
	$contatos->addColumn('nome', 'string',array("length"=>200));
	$contatos->addColumn('bloqueado ', 'string',array('length'=>1, "default"=> 'N'));
	$schema->createTable($contatos);

	if(!$schema->tablesExist('contatos_departamento')){
		$contatos_departamento = new Table("contatos_departamento");
		$contatos_departamento->addColumn('id_contato', 'integer');
		$contatos_departamento->addColumn('id_departamento', 'integer');
		$schema->createTable($contatos_departamento);
	}

}

if (!$schema->tablesExist('fale_conosco')) {

	$fale_conosco = new Table("fale_conosco");
	$fale_conosco->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$fale_conosco->setPrimaryKey(array('id'));

	$fale_conosco->addColumn('email', 'string',array("length"=>100));
	$fale_conosco->addColumn('asunto', 'string',array("length"=>200));
	$fale_conosco->addColumn('msg', 'text');
	$fale_conosco->addColumn('data_cadastro', 'datetime');
	$fale_conosco->addColumn('lido', 'integer',array('length'=>1, "default"=> 0));
	$schema->createTable($fale_conosco);

}

if (!$schema->tablesExist('imagens_menu')) {

	$imagens_menu = new Table("imagens_menu");
	$imagens_menu->addColumn('id_imagem', 'integer');
	$imagens_menu->addColumn('id_menu', 'integer');
	$imagens_menu->addColumn('local', 'string',array('length'=>1,"default"=> "t"));
	$schema->createTable($imagens_menu);
}

if (!$schema->tablesExist('perfil')) {

	$perfil  = new Table("perfil");
	$perfil->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$perfil->setPrimaryKey(array('id'));
	$perfil ->addColumn('perfil', 'string', array('length'=>100));
	$perfil ->addColumn('bloqueado', 'string',array('length'=>1,"default"=> "N"));
	$schema->createTable($perfil );
}

if (!$schema->tablesExist('publicidade')) {

	$publicidade  = new Table("publicidade");
	$publicidade->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$publicidade->setPrimaryKey(array('id'));

	$publicidade ->addColumn('publicidade', 'string', array('length'=>100));
	$publicidade ->addColumn('data_inicio', 'datetime');
	$publicidade ->addColumn('data_fim', 'datetime');

	$publicidade ->addColumn('bloqueado', 'string',array('length'=>1,"default"=> "N"));
	$schema->createTable($publicidade );
}

