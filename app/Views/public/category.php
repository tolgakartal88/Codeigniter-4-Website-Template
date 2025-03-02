<?= $this->extend('defaults/default') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php 
	$dt = new \App\Libraries\DateTimeLibrary()
?>
<?php if (isset($page["category_content"][0]["category_title"])): ?>
	<div class="card mb-1">
		<div class="card-body"> 
			<h5><?= $page["category_content"][0]["category_title"] ?></h5> 
		</div>
	</div> 
	<form id="search-box">
		 
	</form>
	<div id="list-group" class="list-group mt-3"> 
		<?php foreach ($page["category_content"] as $key => $value): ?>  
				<a href="<?=base_url($value["url"]) ?>" class="list-group-item list-group-item">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1 text-truncate"><?=$value["title"] ?></h5>
						<small style="min-width:6.5rem;" title="<?=$dt->dbDateTimeToStr($value["insert_date"]) ?>"><i class="fas fa-calendar me-2"></i><?=$dt->getElapsedTime($value["insert_date"])?></small>
					</div>
					<p class="mb-1 text-truncate" style="max-width:1250px"></p>
					<small>
						<?=$value["description"] ?>
					</small>
				</a>  
		<?php endforeach ?>  
	</div> 		 
<?php endif ?>		 
<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>  
<script type="module" src="<?=base_url("public/js/pages/public/js-public-category.js") ?>"></script>
<?= $this->endSection() ?>
