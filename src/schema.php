<?php 
	use Doctrine\DBAL\Schema\Table;

if (!$schema->tablesExist('paginas')) {
	$paginas = new Table('paginas');
	
	$paginas->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$paginas->setPrimaryKey(array('id'));
	
	$paginas->addColumn('pagina', 'string', array('length' => 100));
	// $paginas->addUniqueIndex(array('username'));
	$paginas->addColumn('link', 'string', array('length' => 50));
	$paginas->addColumn('publicado', 'interger', array('default' => 1));
	$paginas->addColumn('data_publicacao', 'datetime');

	$schema->createTable($paginas);

	$conteudo = new Table("conteudo");
	$paginas->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$paginas->setPrimaryKey(array('id'));
	
	$paginas->addColumn('conteudo', 'text');
	$paginas->addColumn('id_pagina', 'interger', array('unsigned' => true));
	


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

if (!$schema->tablesExist('usuario')) {


	$usuario = new Table("usuario");

	$usuario->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$usuario->setPrimaryKey(array('id'));
	
	$usuario->addColumn('nome', 'string',array("length"=> 255));
	$usuario->addColumn('login', 'string',array("length"=> 40));
	$usuario->addColumn('senha', 'string', array('length' => 50));
	$usuario->addColumn('email', 'string', array('length' => 50));
	$usuario->addColumn('ativo', 'integer');
	$usuario->addColumn('data_cadastro', 'datetime');

	$schema->createTable($usuario);

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

if (!$schema->tablesExist('imagem')) {
	$imagem = new Table("imagem");

	$imagem->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
	$imagem->setPrimaryKey(array('id'));
	
	$imagem->addColumn('imagem', 'string',array("length"=> 50));
	$imagem->addColumn('dir', 'string',array("length"=> 50));
	$schema->createTable($imagem);

	if (!$schema->tablesExist('imagens_menu')) {

		$imagemMenu = new Table("imagens_menu");

		$imagemMenu->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
		$imagemMenu->setPrimaryKey(array('id'));
	
		$imagemMenu->addColumn('id_imagem', 'integer');
		$imagemMenu->addColumn('id_menu', 'integer');
		$schema->createTable($imagemMenu);
	}
}