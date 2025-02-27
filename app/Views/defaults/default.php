<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?= $page["settings"]["title"]?></title>

	<meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

	<link href="<?=base_url("/public/bootstrap-5.0.2/dist/css/bootstrap.min.css") ?>" rel="stylesheet">
	<link href="<?=base_url("/public/fontawesome-6.x/css/fontawesome.css") ?>" rel="stylesheet"  type='text/css'>
	<link rel="stylesheet" href="<?=base_url("/public/fontawesome-6.x/css/all.min.css")?> " rel="stylesheet"> 
 
  	<script type="text/javascript" src="<?=base_url("/public/bootstrap-5.0.2/dist/js/popper.js") ?>"></script>
    <script type="text/javascript" src="<?=base_url("/public/bootstrap-5.0.2/dist/js/bootstrap.min.js") ?>"></script>
    <script type="text/javascript" src="<?=base_url("/public/fontawesome-6.x/js/fontawesome.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("/public/bootstrap-5.0.2/js/jquery.min.js") ?>"></script>
 
	<?= $this->renderSection('header-script') ?>	
</head> 
<body class="custom-color bg-secondary">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?=base_url("/") ?>"><?= $page["settings"]["nav_title"]?></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
			        <?php foreach ($page["menus"] as $v): ?> 
			          <?php if (isset($v["sub_menu"])): ?>
			            <li class="nav-item dropdown">
			              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenu" role="button" data-bs-toggle="dropdown" aria-expanded="true">
			                <?= $v["title"]?>
			              </a>

				          	<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenu">
				            <?php foreach ($v["sub_menu"] as $key => $sv): ?>
				            	<?php if ($sv["sub_title"]=="-"): ?>
				                <div class="dropdown-divider"></div>     
				            	<?php else: ?>
				                <li><a class="dropdown-item" href="<?=base_url($sv["sub_url"])?>"><?= $sv["sub_title"] ?></a></li>    
				                <?php endif ?>          
				            <?php endforeach ?>
				            </ul>

			            </li> 
			            <?php else: ?>
			            <li class="nav-item">
			              <a class="nav-link" aria-current="page" href="<?= base_url($v["url"]) ?>"><?= $v["title"] ?></a>
			            </li>
			          <?php endif ?>
			        <?php endforeach ?>
			    </ul> 
			</div>
		</div>
	</nav>

	<div class="container bg-light p-3">
		<?= $this->renderSection('content') ?>	
	</div>  
	
	<script type="text/javascript" src="<?=base_url("/public/bootstrap-5.0.2/js/bootstrap.min.js") ?>"></script> 
	<script type="text/javascript" src="<?=base_url("/public/bootstrap-5.0.2/js/bootstrap.bundle.min.js") ?>"></script>
	<?= $this->renderSection('footer-script') ?>	 
</body>
</html>