<?= $this->extend('defaults/default-admin') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card mb-1">
	<div class="card-body"> 
	<h5>Dersler</h5>

	</div> 
</div>
<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-md-12">
				<div id="search-box" class="mb-3"></div>
			</div>
			<div class="col-md-12">
				<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#course" data-bs-task="add"><i class="fas fa-plus me-2"></i>Yeni Ekle</button>
				<button id="get-course-list" class="btn btn-primary"><i class="fas fa-list me-2"></i>Listele</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="courses-content" class="courses-content">

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
<script type="module" src="<?=base_url("public/js/pages/admin/js-admin-course.js") ?>"></script>  
<script type="text/javascript">
	/*
	searchBox = document.getElementById("search-box");
	js.createElements(searchBox,[
									{"tag":"label","class":"form-label","for":"search-input","text":"Ara"},
									{"tag":"div" ,"class":"input-group" 
										,"child":
										[ 
											{"tag":"input","id":"search-input","class":"form-control search","type":"search","name":"search-input","placeholder":"Arama yapmak için birşeyler yazın..."}
										]
									},
								]);

	searchBoxInput = document.getElementById("search-input");
	searchBoxListener = (e)=>{ 
		listGroup = document.getElementById("list-group"); 
		listItems = listGroup.getElementsByClassName("dropdown");
		listElements = [].slice.call(listItems)
		listElements.forEach((item)=>{
			var i = item.querySelector("a");
			if (i.textContent.toLowerCase().search(searchBoxInput.value.toLowerCase())<0) {
				item.classList.add("d-none");
				item.classList.remove("d-block");
			}
			else{
				item.classList.add("d-block");
				item.classList.remove("d-none"); 
			}
		})
	}
	searchBoxInput.addEventListener("keyup",searchBoxListener,false);
	searchBoxInput.addEventListener("search",searchBoxListener,false);
	*/
</script>
<?= $this->endSection() ?>