<?= $this->extend('defaults/default-admin') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card mb-1">
	<div class="card-body"> 
	<h5>Şablon HTML</h5>
	</div> 
</div>
<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-md-12">
				<div id="search-box" class="mb-3"></div>
				<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#template-html" data-bs-task="add"><i class="fas fa-plus me-2"></i>Yeni Ekle</button>
				<button id="get-template-html-list" class="btn btn-primary"><i class="fas fa-list me-2"></i>Listele</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="template-html-content" class="template-html-content">

				</div>
			</div>
		</div>
	</div>
</div>
<div id="modal-container"></div>
<?= $this->endSection() ?>

<?= $this->section('footer-script') ?> 
<script type="module" src="<?=base_url("public/js/pages/admin/js-admin-template-html.js") ?>"></script>
<?= $this->endSection() ?>