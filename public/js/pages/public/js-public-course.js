import TaskUrls 	from "../../tasks/task-urls.js";

var downloadWordDoc = document.getElementById("download-word-document");

downloadWordDoc.addEventListener("click",(e)=>{
	var xhr = new XMLHttpRequest();
	var formData = new FormData(); 
	formData.append("id",e.currentTarget.getAttribute("data-id"));
	xhr.open("POST",new TaskUrls().concatBaseUrl("/course/download-word-document"),true);
	xhr.responseType='json';
	xhr.send(formData);
})