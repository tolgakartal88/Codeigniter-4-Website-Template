<?= $this->extend('defaults/default-admin') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card mb-1">
	<div class="card-body"> 
	<h5>Kullanıcılar</h5>

	</div> 
</div>
<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-md-12">
				<div id="search-box" class="mb-3"></div>
			</div>
			<div class="col-md-12">
				<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#user" data-bs-task="add"><i class="fas fa-plus me-2"></i>Yeni Ekle</button>
				<button id="get-user-list" class="btn btn-primary"><i class="fas fa-list me-2"></i>Listele</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="users-content" class="users-content">

				</div>
			</div>
		</div>
	</div>
</div>

<div id="modal-container"></div>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index:11">
	<div id="toast" class="toast" role="alert" data-bs-delay="2000" aria-live="assertive" aria-atomic="true">
		<div class="toast-header">
			<strong class="toast-title me-auto">Parola Kopyala</strong>
			<small class="text-muted">Biraz önce</small>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
		<div class="toast-body">
			Parola Panoya Kopyalandı !!!
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<script type="module" src="<?=base_url("public/js/pages/admin/js-admin-user.js") ?>"></script>
<?= $this->endSection() ?>