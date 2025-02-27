import TaskModals 	from "../../tasks/task-modals.js";
import TaskElements from "../../tasks/task-elements.js";
import TaskUrls 	from "../../tasks/task-urls.js";

var taskElements = new TaskElements();	 
var bodyHtml=[
		{"tag":"form",child:[
			{"tag":"label","class":"form-label","for":"file","text":"Dosya"},
			{"tag":"div" ,"class":"input-group"
				,"child":
				[ 
					{"tag":"input","id":"file","accept":"image/jpeg,image/jpg,image/png","type":"file","class":"form-control","name":"title"},
					{"tag":"div","id":"file-list-box","class":"p-3 w-100"}
				]
			},
			{"tag":"div", "class":"input-group","id":"file-list"}
		]}
		
	]  
var taskElements = new TaskModals("profile-photo","user"); 
taskElements.setModalBody(bodyHtml);
	//taskModals.setEditorSize("md");
	//taskElements.appendElements(document.getElementById("popups"),buttons);
	//taskElements.createElements(document.getElementById("popups"),bodyHtml)  

	//taskElements.setElement();
	
taskElements.setEditorSize("lg");
/*
taskModals2.modalLoaded=(e)=>{ 
	
}
*/
taskElements.doneResultChangeEvent =(args)=>{ 

}  