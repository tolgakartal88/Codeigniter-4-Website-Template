<?= $this->extend('defaults/default') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?> 
<?php foreach ($page["course_content"] as $key => $value): ?>
	<h5><a href="<?= base_url('category/'.$value["category_url"])?>"><?= $value["category_title"] ?></a> > <?= $value["title"] ?> - [ <?= $value["description"] ?> ]</h5> 
	<p><?= $value["content"] ?></p>
	<hr/>
	<button id="download-word-document" class="btn btn-primary mb-1" data-id="<?=$value["id"] ?>"><i class="fas fa-xl fa-file-word me-2"></i>İndir</button> 
	<button class="btn btn-danger mb-1"><i class="fas fa-xl fa-file-pdf me-2"></i>İndir</button>
	<button class="btn btn-primary mb-1"><i class="fas fa-xl fa-anchor me-2"></i>Link Kopyala</button> 
	<button class="btn btn-primary mb-1"><i class="fas fa-xl fa-share me-2"></i>Paylaş</button> 
	<?php $tags =explode(",", $value["tags"])  ?>
	<div class="mt-2">
		<label for="tags"><h5>Etiketler</h5></label>
		<div id="tags" class="">
			<?php foreach ($tags as $value): ?>
				<span class="fw-bold badge rounded-pill bg-success fs-12 me-1"><?=$value?></span>
			<?php endforeach ?>
		</div>
	</div>
<?php endforeach ?> 
<?= $this->endSection() ?>
<?= $this->section('footer-script') ?>
<script type="module" src="<?=base_url("public/js/pages/public/js-public-course.js") ?>"></script>
<?= $this->endSection() ?>