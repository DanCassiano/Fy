<?php 
	use Doctrine\DBAL\Schema\Table;

if (!$schema->tablesExist('paginas')) {
	$paginas = new Table('paginas');
	
	$paginas->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$paginas->setPrimaryKey(array('id'));
	
	$paginas->addColumn('pagina', 'string', array('length' => 100));
	// $paginas->addUniqueIndex(array('username'));
	$paginas->addColumn('link', 'string', array('length' => 50));
	$paginas->addColumn('publicado', 'integer', array('default' => 1));
	$paginas->addColumn('data_publicacao', 'datetime');

	$schema->createTable($paginas);

	$conteudo = new Table("conteudo");
	$conteudo->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$conteudo->setPrimaryKey(array('id'));
	
	$conteudo->addColumn('conteudo', 'text');
	$conteudo->addColumn('id_pagina', 'integer', array('unsigned' => true));
	


    // $app['db']->insert('paginas', array(
    //   'username' => 'fabien',
    //   'password' => '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg==',
    //   'roles' => 'ROLE_USER'
    // ));

    // $app['db']->insert('users', array(
    //   'username' => 'admin',
    //   'password' => '5FZ2Z8QIkA7UTZ4BYkoC+GsReLf569mSKDsfods6LYQ8t+a8EW9oaircfMpmaLbPBh4FOBiiFyLfuZmTSUwzZg==',
    //   'roles' => 'ROLE_ADMIN'
    // ));
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
	$usuarioTable->addColumn('data_cadastro', 'datetime');

	$schema->createTable($usuarioTable);

	$app['db']->insert('usuario', array(
		'nome' => 'admin',
		'email'=> 'admin@admin',
		'senha' => 'd9b1d7db4cd6e70935368a1efb10e377',
		'ativo' => 1,
		'data_cadastro'=> date('Y-m-d H:m:s')
	));
	$app['db']->insert('usuario', array(
		'nome' => 'Jordan',
		'email'=> 'jordan@admin',
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