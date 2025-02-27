<?= $this->extend('defaults/default-user') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $dtl = new \App\Libraries\DateTimeLibrary();?>
<div class="row">
	<div class="col-md-3 mb-2">
		<div class="card text-center">
			<div class="card-header">
				<h5><?= $page["user"]["username"] ?></h5>
			</div>
			<div class="card-body">
				<?php if (empty(session()->get("user")["photo"])): ?>
					<img class='img-fluid img-thumbnail rounded' src='<?= base_url("public/images/default-profile.jpg") ?>'/>
				<?php else: ?>
					<img class='img-fluid img-thumbnail rounded' src='data:image/png;base64,<?=base64_encode(session()->get("user")["photo"])?>'/>
				<?php endif ?>
				<button class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#profile-photo" data-bs-task="add"><i class="fas fa-image me-2"></i>Yükle</button>
				<li class="list-group-item border-0"><?= $page["user"]["first_name"] ." ". $page["user"]["last_name"] ?></li>
				<li class="list-group-item border-0"><?= $page["user"]["login_time"] ?></li>  
			</div>  
		</div>
	</div>
	<div class="col-md-9">
		<div class="card mb-2"> 
			<div class="card-body">
				<h5 class="card-title">Kullanıcı  Hareketleri</h5>
				<hr/>
			</div>
		</div> 
		<div class="card"> 
			<div class="card"> 
				<div class="card-body">
					<h5 class="card-title">Kullanıcı Giriş Hareketleri</h5>
					<hr/>
					<?php foreach ($page["user_log"] as $key => $value): ?>
								<span title="<?=$value["action_time"]?>"><?=$dtl::getElapsedTime($value["action_time"]) ?></span>
								,<span><?=$value["description"] ?></span>
								<?php if (!empty($value["platform"])): ?> 
									,<span><?=$value["platform"] ?></span>
								<?php endif ?>
								<?php if (!empty($value["agent"])): ?> 
									,<span><?=$value["agent"] ?></span>
								<?php endif ?>   
								<?php if (!empty($value["ip_address"]) && strlen($value["ip_address"])>3): ?> 
									,<span><b>İp Adres : </b><?=$value["ip_address"] ?></span>
								<?php endif ?> 
								<br/>
					<?php endforeach ?> 
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modal-container"></div>
<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<script type="module" src="<?=base_url("public/js/pages/admin/js-admin-profile.js") ?>"></script>
<?= $this->endSection() ?>