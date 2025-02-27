import TaskModals 	from "../../tasks/task-modals.js";
import TaskElements from "../../tasks/task-elements.js";
import TaskUrls 	from "../../tasks/task-urls.js";

$(document).ready(()=>{
	var data = new FormData();
	var selectOptions=[];
	data.seperator = false;

	var xhr = new XMLHttpRequest();
	var formData = new FormData();
	formData.append("seperator",false);
	xhr.open("POST",new TaskUrls().concatBaseUrl("/admin/category/get-category-list"),true);
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
				var taskElements = new TaskElements();	
				var objectSelectValues = [];
				xhr.response.forEach((item,index)=>{
					objectSelectValues[index]={id:item.url,title:item.title}; 
				})		
				selectOptions= taskElements.setObjToSelectIdValue(objectSelectValues);
				var bodyHtml=[
						{"tag":"form",child:[
							{"tag":"input","id":"id","class":"hidden","name":"id","type":"hidden"},
							{"tag":"label","class":"form-label","for":"course-list","text":"Kategori"},
							{"tag":"div","class":"input-group" 
								,"child":
								[  
									{"tag":"select","id":"folder-path","class":"form-select folder-path","name":"folder_path","child":selectOptions}
								]
							},
							{"tag":"label","class":"form-label","for":"file","text":"Dosya(lar)"},
							{"tag":"div" ,"class":"input-group"
								,"child":
								[ 
									{"tag":"input","id":"file","type":"file","class":"form-control","name":"title","multiple":"multiple"},
									{"tag":"div","id":"file-list-box","class":"p-3 w-100"}
								]
							},
							{"tag":"div", "class":"input-group","id":"file-list"}
						]}
						
					]  
				var taskModals2 = new TaskModals("image","admin"); 
				taskModals2.setModalBody(bodyHtml);
					//taskModals.setEditorSize("md");
					//taskElements.appendElements(document.getElementById("popups"),buttons);
					//taskElements.createElements(document.getElementById("popups"),bodyHtml)  

					//taskElements.setElement();
					
				taskModals2.setEditorSize("lg");
	/*
				taskModals2.modalLoaded=(e)=>{ 
					
				}
	*/
				taskModals2.doneResultChangeEvent =(args)=>{ 

				}   

				
			}
		} 
	 
})
