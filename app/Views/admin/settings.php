<?= $this->extend('defaults/default-admin') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="setting-tasks" class="form-control">
	<button class="btn btn-primary m-2" name="return-default">Varsayılan Ayarlara Dön</button>
	<button class="btn btn-primary m-2" name="save-changes">Değişiklikleri Kaydet</button>
</div>
<div id="search-box" class="mb-3 mt-3"></div>
<form id="settings-form">
<div id="settings-content" class="settings-content"></div>
</form>
<?= $this->endSection() ?>
<?= $this->section('footer-script') ?> 
<script type="module" src="<?=base_url("public/js/pages/admin/js-admin-settings.js") ?>"></script>
<?= $this->endSection() ?>