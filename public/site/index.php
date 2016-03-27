<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$titulo?></title>
	<?php echo $css ?>
</head>
<body>
	<ul>
		<?php foreach($paginas as $pg): ?>
			<li><a href="<?=$pg['link']?>"><?=$pg['pagina']?></a></li>
		<?php endforeach; ?>
	</ul>
	<div>
		<?php require $dir . "/" .$action . ".php" ?>
	</div>
	<?php echo $js ?>
</body>
</html>