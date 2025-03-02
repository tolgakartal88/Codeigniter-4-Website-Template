<?= $this->extend('defaults/default-user') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col">
		<div class="card mb-1">
			<div class="card-body">
				<h5>Tercihler</h5>
			</div>
		</div>
		<div class="card mb-1">
			<div class="card-body p-2">
				<?php if (empty(session()->get("user")["photo"])): ?>
					<img class='img-fluid img-thumbnail rounded' src='<?= base_url("public/images/default-profile.jpg") ?>' style="width:4rem;height:4rem;"/>
				<?php else: ?>
					<img class='img-fluid img-thumbnail rounded' src='data:image/png;base64,<?=base64_encode(session()->get("user")["photo"])?>' style="width:4rem;height:4rem;"/>
				<?php endif ?>
				<?= session()->get("user")["first_name"] ." ". session()->get("user")["last_name"] ?>
			</div>
		</div> 
		<div class="card mb-1">
			<div class="card-body"> 
				<div id="search-box"></div>
				<div id="preferences-content" class="preferences-content">

				</div>
				<form id="preferences-form">
					<div id="preferences-content" class="preferences-content"></div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="modal-container"></div>
<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<script type="module" src="<?=base_url("public/js/pages/user/js-user-preferences.js") ?>"></script>
<?= $this->endSection() ?>