<?= $this->extend('defaults/default-admin') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="progress">
	<div id="progress-bar" class="progress-bar" role="progressbar" style="width:0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<input id="file-input" type="file" name="file" multiple="" />
<button id="send-post">Yükle</button>

<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<script type="module">
	import TaskUrls from "../public/js/tasks/task-urls.js";
	var sendPost = document.getElementById("send-post");
	sendPost.addEventListener("click",(e)=>{
		var fileInput = document.getElementById("file-input")
		fileInput.addEventListener("click",loadEvent)
		var progressBar = document.getElementById("progress-bar");
		var xhr = (window.XMLHttpRequest? new XMLHttpRequest(): new ActiveXObject("MicrosoftXMLHTTP"))

		
		
		var loadEvent= (e)=>{
			
		progressBar.style.width = 0+"%";
		}

		xhr.upload.onprogress=(e)=>{
			if(e.lengthComputable){
				var percentComplete = e.loaded/ e.total;
				if (Math.round(percentComplete*100)==100) {
					console.log("bitti")
				}
				progressBar.style.width = Math.round(percentComplete*100)+"%";
			}
		}
 
		xhr.addEventListener("load",loadEvent);
		var formData = new FormData();

		let filesElement = [].slice.call(fileInput.files);
		for(const index in filesElement){
			formData.append("file_"+index,filesElement[index]);
		} 


		xhr.open("POST",new TaskUrls().concatBaseUrl("/admin/test-uploads"),true); 
		xhr.responseType='json';
		
		xhr.send(formData);
		
		xhr.onreadystatechange=(e)=>{
			if (xhr.readyState != 4) { return }
				if (xhr.status !=200) {
					//alert(xhr.response.message);  
				}
				else{
					var result= xhr.response; 
				}
			} 

		});

	
	</script>
	<?= $this->endSection() ?>