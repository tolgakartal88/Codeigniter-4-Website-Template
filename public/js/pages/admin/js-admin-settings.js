import TaskModals 	from "../../tasks/task-modals.js";
import TaskElements from "../../tasks/task-elements.js";
import TaskUrls 	from "../../tasks/task-urls.js";
var searchBox = document.getElementById("search-box");
var searchBoxHtml=[
			{"tag":"label","class":"form-label","for":"search-input","text":"Ayarlarda Ara"},
			{"tag":"div" ,"class":"input-group" 
				,"child":
				[ 
					{"tag":"input","id":"search-input","class":"form-control search","type":"search","name":"search-input","placeholder":"Arama yapmak için birşeyler yazın..."}
				]
			},
		  ];
var createSearchBox = new TaskElements();
createSearchBox.addSearchButton(searchBox,searchBoxHtml,"settings-content","list-group-item");

var xhr = new XMLHttpRequest(); 
xhr.open("POST",new TaskUrls().concatBaseUrl("/admin/get-setting-list"),true); 
xhr.responseType='json';
xhr.send(null);
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
			var bodyHtml = [
				{"tag":"div","class":"list-group",child:[
						 
				]}
			] 

			Object.keys(result).forEach((key)=>{
				var item = result[key];
				var contentCapsul = {"tag":"a","class":"list-group-item",child:[
										{"tag":"div","class":"d-flex w-100 justify-content-between",child:[
											{"tag":"h5","class":"mb-1 text-truncate","text":item["title"]},
											{"tag":"small","class":"row-reverse text-end", "style":"min-width:6.5rem;","title":item["set_group_name"],"text":item["set_group_name"],child:[
												{"tag":"i","class":item["set_group_icon"]+" m-2"},	
											]},
										]}, 
										{"tag":"p","class":"mb-1 text-truncate","style":"max-width:1250px"},
										{"tag":"div","class":"form-content" 
											,"child":
											[  
												 
											]
										},
										{"tag":"small","text":item["description"]}

									]} 
 

				switch(item["set_form_type"]){
					case "check":
						contentCapsul.child[2].child.push(
							{"tag":"div","class":"form-check form-switch m-3","child":
							[  
								{"tag":"input","type":"checkbox","id":item["set_key"],"class":"form-check-input","checked":(item["set_value"]=="1"?"checked":""),"name":item["set_key"]},
								{"tag":"label","class":"form-check-label","for":item["set_key"],"text":"Aktif"},
							]
						});
					break;
					case "image":
						contentCapsul.child[2].child.push(
							{"tag":"div","class":"form-input","child":
							[
								{"tag":"img","class":"img-thumbnail me-3","accept":"image/*","style":"width:128px;height:128px;","src":"data:image/ico;base64,"+item["set_value"]},
								{"tag":"input","type":"file","id":item["set_key"],"class":"form-file-input","name":item["set_key"]},
							]
						});
					break;
					default:
					contentCapsul.child[2].child.push({"tag":"input","type":item["set_form_type"],"id":item["set_key"],"class":"form-control","name":item["set_key"],"value":item["set_value"]},);

				}
				bodyHtml[0].child.push(contentCapsul);

				
			})

			var taskElements = new TaskElements();
			taskElements.createElements(document.getElementById("settings-content"),bodyHtml);
		}
	} 

var settingTasks = document.getElementById("setting-tasks");

var returnDefault = settingTasks.querySelector("[name=return-default]");
var saveChanges = settingTasks.querySelector("[name=save-changes]");

returnDefault.addEventListener("click",(e)=>{
});

saveChanges.addEventListener("click",(e)=>{
	var form = document.getElementById("settings-form");
	var formData = new FormData(form);
	var xhr = new XMLHttpRequest(); 
	xhr.open("POST",new TaskUrls().concatBaseUrl("/admin/setting/update"),true); 
	xhr.responseType='json';
	xhr.send(formData);

});