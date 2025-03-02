<?= $this->extend('defaults/default') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card mb-1">
	<div class="card-body"> 
		<h5>İletişim</h5>
	</div> 
</div>
<div class="card mb-1">
	<div class="card-body"> 
		<h6>Sosyal Medya</h6>
		<div>
			<span><i class="fa-brands fa-instagram fa-2x p-3 text-warning"></i><?=$page["contact"]["SOCIAL_INSTAGRAM"] ?></span>
		</div> 
		<div>
			<span><i class="fa-brands fa-twitter fa-2x p-3 text-info"></i><?=$page["contact"]["SOCIAL_TWITTER"] ?></span>
		</div>
		<div>
			<span><i class="fa-brands fa-whatsapp fa-2x p-3 text-success"></i><?=$page["contact"]["SOCIAL_WHATSAPP"] ?></span>
		</div>
		<hr>
		<h6>E - Posta</h6>
		<div>
			<span><i class="fa-solid fa-envelope fa-2x p-3"></i><?=$page["contact"]["CONTACT_EMAIL"] ?></span>
		</div>
		<hr>
		<h6>Adres</h6>
		<div>
			<span><i class="fa-solid fa-location-dot fa-2x p-3 text-danger"></i><?=$page["contact"]["CONTACT_LOCATION"] ?></span>
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<?= $this->endSection() ?>
