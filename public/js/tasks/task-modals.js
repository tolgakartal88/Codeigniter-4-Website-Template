"use strict" 

import TaskUrls from "./task-urls.js";
import TaskElements from "./task-elements.js";


export default class TaskModals{ 
	#urlSeperator = "/";

	#taskElements = new TaskElements(); 

	#selfThis={};

	#modalProperties ={
		id:"",
		modal:{},
		header:{},
		body:{},
		footer:{},
		form:{},
		urls :{
			get:"",
			add:"",
			remove:"",
			update:"",
			preview:"",
		}
	}

	#modal = [
				{tag:"div",id:"",class:"modal",tabindex:"-1",child:[
					{tag:"div",class:"modal-dialog modal-lg",child:[
						{tag:"div", class:"modal-content",child:[
							{tag:"div", class:"modal-header flex-column text-start",child:[
								{tag:"h5",class:"header-text",text:"Modal Header"}, 
								{tag:"div",class:"progress w-100",style:"height:2px;",child:[
									{tag:"div",id:"progress-bar",height:"5px",class:"progress-bar",role:"progressbar",style:"width:0%","aria-valuenow":"0","aria-valuemin":"0","aria-valuemax":"100"}
								]}
							]},
							{tag:"div", id:"", class:"modal-body", child:[]},
							{tag:"div", id:"", class:"modal-footer",child:[
								{tag:"div",class:"form-group m-2 text-end",child:[

									]}
							]}	
						]},
					]}
				]}
			];

	#modalButtons={
		yes:{tag:"button",type:"button",class:"btn btn-danger action-btn-yes m-1","data-bs-task":"task-save",text:"Evet"},
		no:{tag:"button",type:"button",class:"btn btn-secondary action-btn-no m-1","data-bs-task":"task-save","data-bs-dismiss":"modal",text:"Hayır"},
		save:{tag:"button",type:"button",class:"btn btn-primary action-btn-save m-1","data-bs-task":"task-save",text:"Kaydet"},
		cancel:{tag:"button",type:"button",class:"btn btn-secondary action-btn-cancel m-1","data-bs-task":"task-save","data-bs-dismiss":"modal",text:"Vazgeç"},
		ok:{tag:"button",type:"button",class:"btn btn-primary action-btn-ok m-1","data-bs-task":"task-ok","data-bs-dismiss":"modal",text:"Tamam"},
	}

	#editorSize="sm";

	constructor(id="modal",subController="/"){ 
		this.#selfThis = this;
		this.#modalProperties.id=id;
		this.#modal[0].id = id; 
		var urls = new TaskUrls();
		Object.keys(this.#modalProperties.urls).forEach((key)=>{
			this.#modalProperties.urls[key] = urls.concatBaseUrl(this.#urlSeperator+subController+this.#urlSeperator+this.#modalProperties.id+this.#urlSeperator+key);
		})
 
		this.#taskElements.appendElements(document.getElementById("modal-container"),this.#modal);
		this.#modalProperties.modal = document.getElementById(this.#modalProperties.id);
		this.#modalProperties.header = this.#modalProperties.modal.querySelector(".modal-header");
		this.#modalProperties.body = this.#modalProperties.modal.querySelector(".modal-body");
		this.#modalProperties.footer = this.#modalProperties.modal.querySelector(".modal-footer"); 

		this.#modalProperties.modal.addEventListener("show.bs.modal",this.#modalShowBsEvent);
		this.#modalProperties.modal.addEventListener("shown.bs.modal",this.modalLoaded);
		this.#modalProperties.modal.addEventListener("shown.bs.modal",this.modalLoadedExport);
		this.#modalProperties.modal.addEventListener("hide.bs.modal",this.#modalHideBsEvent);

	}

	#modalShowBsEvent=(e)=>{
		if (e.target.getAttribute("opened-modal")=="1") {return}  

		let btn = e.relatedTarget;
		let task = btn.getAttribute("data-bs-task"); 
		let affirmativeBtn;  

			switch(task){
			case "add":
			this.#taskElements.createElements(this.#modalProperties.body,this.#modalProperties.form);
			this.#setButtons(["save","cancel"]);
			this.#setHeaderText("Yeni Ekle");
			this.setModalSize(this.#editorSize);
			affirmativeBtn = this.#modalProperties.footer.querySelector(".action-btn-save");
			this.#taskElements.checkCKEditor(this.#modalProperties.body.querySelector("form"))
			break;

			case "remove":
			this.#setButtons(["yes","no"]);
			this.#taskElements.createElements(this.#modalProperties.body,[{tag:"h5",text:"\""+btn.getAttribute("data-bs-title")+"\" Kayıt Silinecek Onaylıyor Musunuz?"}]);
			this.#setHeaderText("Sil");
			this.setModalSize("md");
			affirmativeBtn = this.#modalProperties.footer.querySelector(".action-btn-yes");
			affirmativeBtn.id = e.relatedTarget.getAttribute("data-bs-id");
			break;

			case "update":
			this.#taskElements.createElements(this.#modalProperties.body,this.#modalProperties.form);
			this.#taskElements.checkCKEditor(this.#modalProperties.body.querySelector("form"))
			this.#setButtons(["save","cancel"]);
			this.#setHeaderText("Güncelle");  

			var xhr = new XMLHttpRequest();
			var formData = new FormData();
			formData.append("id",btn.getAttribute("data-bs-id"));
			xhr.open("POST",this.#modalProperties.urls.get,true);
			//xhr.setRequestHeader("Content-Type","multipart/form-data");
			xhr.responseType='json';
			xhr.send(formData);
			xhr.onreadystatechange=(e)=>{
				if (xhr.readyState != 4) { return }
					if (xhr.status !=200) {
						let result={
							status:false,
							message:"Status : "+xhr.status,
							data:null
						}; 
					}
					else{
						var result= xhr.response;

						var formElements = this.#modalProperties.body.querySelector("form");
						this.#taskElements.setFormElementData(formElements,result[0]);
					}
				} 

			this.setModalSize(this.#editorSize);
			affirmativeBtn = this.#modalProperties.footer.querySelector(".action-btn-save");
			affirmativeBtn.id = e.relatedTarget.getAttribute("data-bs-id");

			break;
			case "preview":
			this.#setButtons(["ok"]);
			this.#setHeaderText("Önizleme"); 

			var xhr = new XMLHttpRequest();
			var formData = new FormData();
			formData.append("id",btn.getAttribute("data-bs-id"));
			xhr.open("POST",this.#modalProperties.urls.preview,true);
			//xhr.setRequestHeader("Content-Type","multipart/form-data");
			xhr.responseType='json';
			xhr.send(formData);
			xhr.onreadystatechange=(e)=>{
				if (xhr.readyState != 4) { return }
					if (xhr.status !=200) {
						let result={
							status:false,
							message:"Status : "+xhr.status,
							data:null
						}; 
					}
					else{
						var result= xhr.response;

						var formElements = this.#modalProperties.body;
						formElements.innerHTML= xhr.response;
					}
				} 

			this.setModalSize(this.#editorSize);
			break;

		}

		if (affirmativeBtn!==null && affirmativeBtn !==undefined) {
			affirmativeBtn.addEventListener("click",this.#ActionBtnAffirmativeClickListener,false);
			affirmativeBtn.selfThis=this.#selfThis;
			affirmativeBtn.taskType=task
		}

		this.modalLoadedExport(e);
		e.target.setAttribute("opened-modal","1");
	}

	#modalHideBsEvent = (e)=>{ 
		e.target.removeAttribute("opened-modal");
		e.target.removeAttribute("opened-shown-modal");
		let progressbar =this.#modalProperties.header.querySelector(".progress-bar")
		progressbar.style.width = 0;
		if (document.activeElement) {
            document.activeElement.blur();
        }
	}


	setModalSize(size){
		let modal = this.#modalProperties.modal.querySelector(".modal-dialog");
		modal.classList.remove(...modal.classList);
		modal.classList.add("modal-dialog")
		modal.classList.add("modal-"+size);
	}

	setEditorSize(size="sm"){
		this.#editorSize = size;
	}
	setModalBody(jsonHtml=[]){
		this.#modalProperties.form = jsonHtml;
	}

	#setButtons(buttons=["ok"]){ 
		var btns = [];
		buttons.forEach((item)=>{
			btns.push(this.#modalButtons[item]);
		})

		this.#taskElements.createElements(this.#modalProperties.footer,btns);

	}

	#setHeaderText(header){
		this.#modalProperties.header.querySelector("h5").innerHTML=header;
	}

	#ActionBtnAffirmativeClickListener=(e)=>{   
		let selfThis = e.currentTarget.selfThis;
		let taskType = e.currentTarget.taskType;
		var formData = new FormData(); 
		var xhrUrl ="";
		switch(taskType){
			case "add":
			xhrUrl = this.#modalProperties.urls.add 
			formData = this.#taskElements.getFormElementData(this.#modalProperties.body.querySelector("form"));
			break;

			case "update":  
			xhrUrl = this.#modalProperties.urls.update
			formData = this.#taskElements.getFormElementData(this.#modalProperties.body.querySelector("form"));
			formData.append("id",e.currentTarget.id); 
			break;

			case "remove": 
			xhrUrl = this.#modalProperties.urls.remove
			var formData = new FormData(); 
			formData.append("id",e.currentTarget.id);    
			break

		}
		
		var xhr = new XMLHttpRequest();
		xhr.upload.onprogress=(e)=>{
			if(e.lengthComputable){
				var percentComplete = e.loaded/ e.total;
				let progressbar =this.#modalProperties.header.querySelector(".progress-bar")
				progressbar.style.width = Math.round(percentComplete*100)+"%";
			}
		}

		xhr.onload=(e)=>{
			let closeBtn =this.#modalProperties.footer.querySelector("[data-bs-dismiss=modal]");
			setTimeout(function(){
				closeBtn.click(); 
			},1000);
		}
 
		xhr.open("POST",xhrUrl,true);
		//xhr.setRequestHeader("Content-Type","multipart/form-data");
		xhr.responseType='json';
		xhr.send(formData);
		xhr.onreadystatechange=(e)=>{
			if (xhr.readyState != 4) { return }
				if (xhr.status !=200) {
					selfThis.doneResultChangeEvent({
						status:false,
						message:"Status : "+xhr.status,
						data:null
					}); 
				}
				else{
					selfThis.doneResultChangeEvent({
						status:true,
						message:taskType,
						data:xhr.response
					}); 
				}
			} 

		
	}

	doneResultChangeEvent=(args)=>{

	}

	modalLoaded=(e)=>{ 

		if (e.target.getAttribute("opened-shown-modal")=="1") {return}  
		var fileList = this.#modalProperties.body.querySelector("[type=file]");
		if (!!fileList) {
			fileList.addEventListener("change",(e)=>{

					var fileListHtml =[{"tag":"ol",child:[]}]
					let filesElement = [].slice.call(fileList.files);
						for(const index in filesElement){
						fileListHtml[0].child.push({"tag":"li","text":"("+(filesElement[index].size/1024).toFixed(2) +" KB)- "+filesElement[index].name})
						}
					this.#taskElements.createElements(fileList.parentElement.querySelector("#file-list-box"),fileListHtml);

			});
		}

		e.target.setAttribute("opened-shown-modal","1");

	}

	modalLoadedExport=(e)=>{
		var x=e;
	}

}
 

