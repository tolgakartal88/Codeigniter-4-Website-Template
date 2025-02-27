<?= $this->extend('defaults/default-admin') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card mb-1">
	<div class="card-body"> 
	<h5>İndirmeler</h5>

	</div> 
</div>
<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-md-12">
				<form id="search-box">
			 
				</form>
			</div>
			<div class="col-md-12">
				<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#download" data-bs-task="add"><i class="fas fa-plus me-2"></i>Yeni Ekle</button>
				<a class="btn btn-primary" href="<?=base_url("admin/downloads") ?>"><i class="fas fa-home me-2"></i> Kök Dizin</a>
			</div> 
			<div class="col-md-12">
				Max Size : <?=ini_get("upload_max_filesize") ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="download-content">
					<?php foreach ($page["explorer_list"] as $key => $value): ?>
						<?php if ($value["type"]=="folder"): ?>
							<li class="text-start list-group-item list-group-item-action">
								<i class="fas fa-xl fa-folder m-2" style="color:<?=(substr($value["name"], 0,1).substr(strrev($value["name"]), 0,1)=="__"?"tomato":"#FFCD45") ?>;"></i>
								<a href="<?=base_url("admin/download/get-download-list/".$value["name"]) ?>"><?=$value["name"] ?></a>
							</li>
							<?php else: ?>
							<li class="text-start list-group-item list-group-item-action justify-content-center">
								<i class="fas fa-xl fa-file<?=(in_array($value["extension"],array("jpg","png","jpeg","gif"))?"-image":""); ?> text-primary m-2"></i> 
								<a class="look-at-me" href="<?=$value["url"]?>"><i class="fas fa-xl fa-download text-primary m-2"></i></a>
								<span><?=$value["name"] ?> </span>
							</li>
						<?php endif ?>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div> 
<div id="modal-container"></div>


<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<script type="module" src="<?=base_url("public/js/pages/admin/js-admin-download.js") ?>"></script>  
<script type="text/javascript">
	var loogAtMe = document.getElementsByClassName("look-at-me");
	funLookAtMe=(e)=>{
		var target = e.currentTarget;
		var url =decodeURI(target.getAttribute("data-url")); 
	}
	Object.keys(loogAtMe).forEach((index)=>{
		loogAtMe[index].addEventListener("click",funLookAtMe);
		
	})


</script>
<?= $this->endSection() ?>