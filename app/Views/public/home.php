<?= $this->extend('defaults/default') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php 
	$dt = new \App\Libraries\DateTimeLibrary()
?>
<h5>Anasayfa</h5> 
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
  	<?php foreach ($page["last_categories"] as $key => $value): ?>
  		<button class="nav-link <?=($key==0?"active":"") ?>" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-<?=$key?>" type="button" role="tab" aria-controls="nav-<?=$key?>" aria-selected="true"><?=$value?></button> 
  	<?php endforeach ?> 
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
	<?php foreach ($page["last_categories"] as $key => $value): ?> 
		<div class="tab-pane fade <?=($key==0?"show active":"") ?>" id="nav-<?=$key?>" role="tabpanel" aria-labelledby="nav-<?=$key?>-tab">
		<?php 
			$filterBy = $value; // or Finance etc.

			$new = array_filter($page["last_courses"], function ($var) use ($filterBy) {
			    return ($var['category_title'] == $filterBy);
			}); 
		 ?> 
		 	<div class="list-group">
				 <?php foreach ($new as $key => $v): ?>
					  <a href="<?= base_url($v["url"]) ?>" class="list-group-item list-group-item-action" aria-current="true">
					    <div class="d-flex w-100 justify-content-between">
					      <h5 class="mb-1 text-truncate"><?=$v["title"] ?></h5>
						  <small style="min-width:6.5rem;" title="<?=$dt->dbDateTimeToStr($v["insert_date"]) ?>"><i class="fas fa-calendar me-2"></i><?=$dt->getElapsedTime($v["insert_date"])?></small>
					    </div>
					    <p class="mb-1"><?=$v["description"] ?></p>
					    <small><?=$v["category_title"] ?></small>
					  </a> 
				 <?php endforeach ?>
			</div>
		</div>
  	<?php endforeach ?> 
</div>
<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<?= $this->endSection() ?>
