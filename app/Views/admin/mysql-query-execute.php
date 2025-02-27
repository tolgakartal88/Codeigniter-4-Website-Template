<?= $this->extend('defaults/default-admin') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card mb-1">
	<div class="card-body"> 
	<h5>MySQL Query Çalıştır</h5>
	</div> 
</div>
<div class="card mb-1">
	<div class="card-body"> 
	<h5 id="error"></h5>
	</div> 
</div>
<div class="row">
	<div class="col-md">
		<form>
			<textarea id="query" class="form-control mb-3 w-100 text-start" style="height:15rem;">select * from queries</textarea>
			<button id="run-btn" class="btn btn-primary"><i class="fas fa-circle-play me-2"></i>Çalıştır</button>
			<button id="clear-btn" class="btn btn-primary"><i class="fas fa-eraser me-2"></i>Temizle</button>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md">
		<h5 id="error"></h5>
	</div>
</div>
<div class="row">
	<div class="col-md table-responsive">
		<table class="table">
			<thead>
				<tr id="table-head"></tr>
			</thead>
			<tbody id="table-body">
				
			</tbody>
		</table>
	</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<script type="module">

	import TaskUrls from "../public/js/tasks/task-urls.js";
	var clearBtn = document.getElementById("clear-btn");
	var runBtn = document.getElementById("run-btn");
	var query = document.getElementById("query");
	clearBtn.addEventListener("click",(e)=>{
		query.value="";
		e.preventDefault();
	})

	runBtn.addEventListener("click",(e)=>{
		var error = document.getElementById("error");
		error.innerText="";
		e.preventDefault();
		var xhr = new XMLHttpRequest();
		var formData = new FormData();
		formData.append("query",query.value);
		xhr.open("POST",new TaskUrls().concatBaseUrl("/admin/mysql-query-execute/run"),true); 
		xhr.responseType='json';
		xhr.send(formData);
		xhr.onreadystatechange=(e)=>{
			if (xhr.readyState != 4) { return }
				if (xhr.status !=200) { 
					error.innerText =  xhr.response.message; 

					var head = document.getElementById("table-head");
					var body = document.getElementById("table-body");
					head.innerText="";
					body.innerText="";
				}
				else{
					var result= xhr.response;
					if (xhr.response.error!="") { 
						error.innerText =  xhr.response.error; 
						return
					}
					var head = document.getElementById("table-head");
					var body = document.getElementById("table-body");
					head.innerHTML="";
					error.innerText =  "İşlem Başarılı! \nKayıt Sayısı : "+Object.keys(xhr.response.data).length; 
					Object.keys(xhr.response.data[0]).forEach((column)=>{
						head.innerHTML+="<th>"+column+"</th>";
					})  
					var iHtml="";
					xhr.response.data.forEach((item)=>{
						iHtml+="<tr>"; 
						Object.keys(xhr.response.data[0]).forEach((column)=>{
							iHtml+="<td class='text-truncate'><textarea class='w-100 mb-0 border border-0 bg-transparent'>"+item[column]+"</textarea></td>";
						})  
						iHtml+="</tr>";
					})
					body.innerHTML=iHtml;



				}
			} 
		});
	</script>
	<?= $this->endSection() ?>