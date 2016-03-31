<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?=$titulo ?></title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="<?=$baseURL?>bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="<?=$baseURL?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
		<link rel="stylesheet" href="<?=$baseURL?>plugins/elFinder-2.1.9/css/elfinder.min.css">


		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?=$css?>
		<link rel="stylesheet" href="<?=$baseURL?>dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="<?=$baseURL?>dist/css/skins/_all-skins.min.css">
		<base href="<?=$baseURL?>"></base>
	</head>
	<body class="hold-transition skin-blue sidebar-collapse sidebar-mini fixed">
		<div class="wrapper">
			<header class="main-header">
				<!-- Logo -->
				<a href="" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>A</b>dm</span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b>Admin</b>istrator</span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
					<!-- Navbar Right Menu -->
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- Mensagem do faleconsoco-->
							<li class="dropdown messages-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Mensagens do Faleconosco	">
									<i class="fa fa-envelope-o"></i>
									<span class="label label-success"><?php echo $qtdFaleConosco ?></span>
								</a>
								<ul class="dropdown-menu">
									<li class="header">você tem <?php echo $qtdFaleConosco ?></li>
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu">
											<?php foreach($mensagens as $m ){ ?>
												<li><!-- start message -->
													<a href="<?=$baseURL?>site/faleconosco/view?id=<?=$m['id']?>">
														<h4><?=$m['email']?><small><i class="fa fa-clock-o"></i><?=strftime("%r", strtotime($m['data_criacao']))?></small></h4>
														<p><?=$m['asunto']?></p>
													</a>
												</li><!-- end message -->
											<?php } ?>
										</ul>
									</li>
									<li class="footer">
										<a href="<?=$baseURL?>site/faleconosco/">Visualizar todas</a>
									</li>
								</ul>
							</li>
						
							
							<!-- User Account: style can be found in dropdown.less -->
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="../upload/usuario/<?=$userImagem?>" class="user-image" alt="<?=$userNome?>">
									<span class="hidden-xs"><?=$userNome?></span>
								</a>
								<ul class="dropdown-menu">
									<!-- User image -->
									<li class="user-header">
										<img src="../upload/usuario/<?=$userImagem?>" class="img-circle" alt="User Image">
										<p><?=$userNome?></p>
									</li>
									<!-- Menu Footer-->
									<li class="user-footer">
										<!-- <div class="pull-left">
											<a href="#" class="btn btn-default btn-flat">Profile</a>
										</div> -->
										<div class="pull-right">
											<a href="logout" class="btn btn-default btn-flat">Sair</a>
										</div>
									</li>
								</ul>
							</li>
							<!-- Control Sidebar Toggle Button -->
							<li>
								<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<!-- Sidebar user panel -->
				<!-- 	<div class="user-panel">
						<div class="pull-left image">
							<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
						</div>
						<div class="pull-left info">
							<p>Alexander Pierce</p>
							<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
						</div>
					</div> -->
					<!-- search form -->
					<form action="#" method="get" class="sidebar-form">
						<div class="input-group">
							<input type="text" name="q" class="form-control" placeholder="Buscar...">
							<span class="input-group-btn">
								<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
					<!-- /.search form -->
					<!-- sidebar menu: : style can be found in sidebar.less -->
					<ul class="sidebar-menu">
						<li class="treeview">
							<a href="#">
								<i class="fa fa-laptop"></i>
								<span>Site</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li class="">
									<a href="site/menu">
										<i class="fa fa-clone"></i>
										Menu
									</a>
								</li>
								<li class="">
									<a href="site/galeria">
										<i class="fa fa-image"></i>
										Imagens
									</a>
								</li>
								<li class="">
									<a href="#">
										<i class="fa  fa-bullhorn"></i>
										Fale conosco
										<i class="fa fa-angle-left pull-right"></i>
										<ul class="treeview-menu">
											<li class="">
												<a href="site/departamentos">
													<i class="fa fa-circle-o"></i>
													Departamentos
												</a>
											</li>
											<li class="">
												<a href="site/faleconosco">
													<i class="fa fa-circle-o"></i>
													Fale conosco
												</a>
											</li>
										</ul>
									</a>
								</li>
								<li class="">
									<a href="#">
										<i class="fa fa-diamond"></i>
										Publicidades
										<i class="fa fa-angle-left pull-right"></i>
										<ul class="treeview-menu">
											<li class="">
												<a href="site/publicidade">
													<i class="fa fa-circle-o"></i>
													publicidade
												</a>
											</li>
										</ul>
									</a>
								</li>
								<li class="">
									<a href="site/perfil">
										<i class="fa fa-object-group"></i>
										Perfil
									</a>
								</li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-child"></i>
								<span>Usuários</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu menu-open" >
								<li><a href="usuario/users"><i class="fa fa-circle-o"></i> Usuários</a></li>	
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-eye"></i>
								<span>Log</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu menu-open" >
								<li><a href="log/users"><i class="fa fa-circle-o"></i>Atividades</a></li>	
							</ul>
						</li>
					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<?php if($action){ ?>
					<h1>
						<?=$action?>
						<small><?=$modulo?></small>
					</h1>
					<?php } ?>
					
					<ol class="breadcrumb">
						<li><a href="<?=$baseURL?>"><i class="fa fa-dashboard"></i> Home</a></li>
						<?php if($action){ ?>
						<li class=""><?=$action?></li>
						<?php } ?>
						<?php if($modulo){ ?>
						<li class="active"><?=$modulo?></li>
						<?php } ?>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<?php
						if( !empty($action ) && empty($operacao))
							require $dir . "view/" . $action . "/" . $modulo . ".php"; 
						elseif( !empty($action ) && !empty($operacao))
							require $dir . "view/" . $action . "/{$operacao}-" . $modulo . ".php"; 
					?>
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->
			<footer class="main-footer"></footer>
			<!-- Control Sidebar -->
			<aside class="control-sidebar control-sidebar-dark">
				<!-- Create the tabs -->
				<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
					<li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
					<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<!-- Home tab content -->
					<div class="tab-pane" id="control-sidebar-home-tab">
						<h3 class="control-sidebar-heading">Recent Activity</h3>
						<ul class="control-sidebar-menu">
							<li>
								<a href="javascript::;">
									<i class="menu-icon fa fa-birthday-cake bg-red"></i>
									<div class="menu-info">
										<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
										<p>Will be 23 on April 24th</p>
									</div>
								</a>
							</li>
							<li>
								<a href="javascript::;">
									<i class="menu-icon fa fa-user bg-yellow"></i>
									<div class="menu-info">
										<h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
										<p>New phone +1(800)555-1234</p>
									</div>
								</a>
							</li>
							<li>
								<a href="javascript::;">
									<i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
									<div class="menu-info">
										<h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
										<p>nora@example.com</p>
									</div>
								</a>
							</li>
							<li>
								<a href="javascript::;">
									<i class="menu-icon fa fa-file-code-o bg-green"></i>
									<div class="menu-info">
										<h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
										<p>Execution time 5 seconds</p>
									</div>
								</a>
							</li>
						</ul><!-- /.control-sidebar-menu -->
						<h3 class="control-sidebar-heading">Tasks Progress</h3>
							<ul class="control-sidebar-menu">
								<li>
									<a href="javascript::;">
										<h4 class="control-sidebar-subheading">
											Custom Template Design
											<span class="label label-danger pull-right">70%</span>
										</h4>
										<div class="progress progress-xxs">
											<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
										</div>
									</a>
								</li>
								<li>
									<a href="javascript::;">
										<h4 class="control-sidebar-subheading">
											Update Resume
											<span class="label label-success pull-right">95%</span>
										</h4>
										<div class="progress progress-xxs">
											<div class="progress-bar progress-bar-success" style="width: 95%"></div>
										</div>
									</a>
								</li>
								<li>
									<a href="javascript::;">
										<h4 class="control-sidebar-subheading">
											Laravel Integration
											<span class="label label-warning pull-right">50%</span>
										</h4>
										<div class="progress progress-xxs">
											<div class="progress-bar progress-bar-warning" style="width: 50%"></div>
										</div>
									</a>
								</li>
								<li>
									<a href="javascript::;">
										<h4 class="control-sidebar-subheading">
											Back End Framework
											<span class="label label-primary pull-right">68%</span>
										</h4>
										<div class="progress progress-xxs">
											<div class="progress-bar progress-bar-primary" style="width: 68%"></div>
										</div>
									</a>
								</li>
							</ul><!-- /.control-sidebar-menu -->
						</div><!-- /.tab-pane -->
						<!-- Settings tab content -->
						<div class="tab-pane" id="control-sidebar-settings-tab">
							<form method="post">
								<h3 class="control-sidebar-heading">General Settings</h3>
								<div class="form-group">
									<label class="control-sidebar-subheading">
										Report panel usage
										<input type="checkbox" class="pull-right" checked>
									</label>
									<p>Some information about this general settings option</p>
								</div><!-- /.form-group -->
								<div class="form-group">
									<label class="control-sidebar-subheading">
										Allow mail redirect
										<input type="checkbox" class="pull-right" checked>
									</label>
									<p>Other sets of options are available</p>
								</div><!-- /.form-group -->
								<div class="form-group">
									<label class="control-sidebar-subheading">
										Expose author name in posts
										<input type="checkbox" class="pull-right" checked>
									</label>
									<p>Allow the user to show his name in blog posts</p>
								</div><!-- /.form-group -->
								<h3 class="control-sidebar-heading">Chat Settings</h3>
								<div class="form-group">
									<label class="control-sidebar-subheading">
										Show me as online
										<input type="checkbox" class="pull-right" checked>
									</label>
								</div><!-- /.form-group -->
								<div class="form-group">
									<label class="control-sidebar-subheading">
										Turn off notifications
										<input type="checkbox" class="pull-right">
									</label>
								</div><!-- /.form-group -->
								<div class="form-group">
									<label class="control-sidebar-subheading">
										Delete chat history
										<a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
									</label>
								</div><!-- /.form-group -->
							</form>
						</div><!-- /.tab-pane -->
					</div>
				</aside><!-- /.control-sidebar -->
			<!-- Add the sidebar's background. This div must be placed
			immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div><!-- ./wrapper -->

		<div class="mascara" style="display:none">
			<div class="box box-solid" id="boxFiles" >
				<div class="box-header with-border">
					<h3 class="box-title">Arquivos</h3>
					<div class="pull-right">
						<a href="#fechar" class="btn "><i class="fa fa-fw fa-close"></i></a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body" style="overflow: auto">
					<ul id="files" class="mailbox-attachments clearfix"></ul>
				</div>
				<!-- /.box-body -->
			</div>
		</div>



		<!-- jQuery 2.1.4 -->
		<script src="<?=$baseURL?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- jquery ui -->
		<script src="<?=$baseURL?>plugins/jQueryUI/jquery-ui.min.js"></script>
		<!-- Bootstrap 3.3.5 -->
		<script src="<?=$baseURL?>bootstrap/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="<?=$baseURL?>plugins/fastclick/fastclick.min.js"></script>
		<!-- AdminLTE App -->
		<script src="<?=$baseURL?>dist/js/app.min.js"></script>
		<!-- Sparkline -->
		<script src="<?=$baseURL?>plugins/sparkline/jquery.sparkline.min.js"></script>
		<!-- jvectormap -->
		<script src="<?=$baseURL?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="<?=$baseURL?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<!-- SlimScroll 1.3.0 -->
		<script src="<?=$baseURL?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- ChartJS 1.0.1 -->
		<!-- <script src="<?=$baseURL?>/plugins/chartjs/Chart.min.js"></script> -->
		<!-- file -->
		<script src="<?=$baseURL?>plugins/elFinder-2.1.9/js/elfinder.min.js"></script>
		<script src="<?=$baseURL?>plugins/elFinder-2.1.9/js/i18n/elfinder.pt_BR.js"></script>


		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<!-- <script src="<?=$baseURL?>/dist/js/pages/dashboard2.js"></script> -->
		<!-- AdminLTE for demo purposes -->
		<script src="<?=$baseURL?>dist/js/demo.js"></script>
		<?=$js ?>
	</body>
</html>