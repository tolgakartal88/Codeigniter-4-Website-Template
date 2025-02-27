<html>
<head>
	<title><?= $page["settings"]["title"]?> - Kullanıcı Girişi</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="<?=base_url("/public/bootstrap-5.0.2/dist/css/bootstrap.min.css") ?>" rel="stylesheet">
	<link href="<?=base_url("/public/fontawesome-6.x/css/fontawesome.css") ?>" rel="stylesheet"  type='text/css'>
	<link rel="stylesheet" href="<?=base_url("/public/fontawesome-6.x/css/all.min.css")?> " rel="stylesheet"> 

	<script type="text/javascript" src="<?=base_url("/public/bootstrap-5.0.2/dist/js/popper.js") ?>"></script>
	<script type="text/javascript" src="<?=base_url("/public/bootstrap-5.0.2/dist/js/bootstrap.min.js") ?>"></script>
	<script type="text/javascript" src="<?=base_url("/public/fontawesome-6.x/js/fontawesome.js")?>"></script>
	<script type="text/javascript" src="<?=base_url("/public/bootstrap-5.0.2/js/jquery.min.js") ?>"></script>

</head>
<body class="text-center">

<div class="container">
	<style>
	.bd-placeholder-img {
	font-size: 1.125rem;
	text-anchor: middle;
	-webkit-user-select: none;
	-moz-user-select: none;
	user-select: none;
		}

		@media (min-width: 768px) {
		.bd-placeholder-img-lg {
		  font-size: 3.5rem;
		}
	}

	html,	
	body {
	  height: 100%;
	}

	body {
	  display: flex;
	  align-items: center;
	  padding-top: 40px;
	  padding-bottom: 40px;
	  background-color: #f5f5f5;
	}

	.form-signin {
	  width: 100%;
	  max-width: 330px;
	  padding: 15px;
	  margin: auto;
	}

	.form-signin .checkbox {
	  font-weight: 400;
	}

	.form-signin .form-floating:focus-within {
	  z-index: 2;
	}

	.form-signin input[type="username"] {
	  margin-bottom: -1px;
	  border-bottom-right-radius: 0;
	  border-bottom-left-radius: 0;
	}

	.form-signin input[type="password"] {
	  margin-bottom: 10px;
	  border-top-left-radius: 0;
	  border-top-right-radius: 0;
	}
</style>
<div id="validation-area" class="row"></div>
<main class="form-signin" id="form-signin">
  <form id="login-form" method="post" action="<?=base_url('/log/in')?>">
    <!--<img class="mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
    <h1 class="h3 mb-3 fw-normal"><?= $page["settings"]["nav_title"]?></h1>
    <h1 class="h5 mb-3 fw-normal">Kullanıcı Girişi</h1>

    <div class="form-floating">
      <input type="username" name="username" class="form-control" id="floatingInput" placeholder="Username">
      <label for="floatingInput">Kullanıcı Adı</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Şifre</label>
    </div> 
    <div class="justfy-content-center">
	    <button class="btn btn-lg btn-primary" class="action-btn" type="submit">Giriş Yap</button>
	    <a class="btn btn-lg btn-secondary" href="<?=base_url('/')?>">Anasayfa</a>
	</div>
	
    <p class="mt-5 mb-3 text-muted">©2024</p>
  </form>

</main> 
<script type="module" src="<?=base_url("/public/js/pages/public/js-public-log.js") ?>">"></script>
	
</div>
<script type="text/javascript" src="<?=base_url("/public/bootstrap-5.0.2/js/bootstrap.min.js") ?>"></script> 
<script type="text/javascript" src="<?=base_url("/public/bootstrap-5.0.2/js/bootstrap.bundle.min.js") ?>"></script>
<script> 
</script>
	
</body>
</html>