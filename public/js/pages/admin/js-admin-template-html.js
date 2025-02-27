import TaskModals 	from "../../tasks/task-modals.js";
import TaskElements from "../../tasks/task-elements.js";
import TaskUrls 	from "../../tasks/task-urls.js";

var searchBox = document.getElementById("search-box");
var searchBoxHtml=[
			{"tag":"label","class":"form-label","for":"search-input","text":"Ara"},
			{"tag":"div" ,"class":"input-group" 
				,"child":
				[ 
					{"tag":"input","id":"search-input","class":"form-control search","type":"search","name":"search-input","placeholder":"Arama yapmak için birşeyler yazın..."}
				]
			},
		  ];
var createSearchBox = new TaskElements();
createSearchBox.addSearchButton(searchBox,searchBoxHtml,"template-html-content","list-group-item");

var js = new TaskElements();

var bodyHtml=[
			{"tag":"form","class":"h-100", "child":[
				{"tag":"input","id":"id","class":"hidden","name":"id","type":"hidden"},
				{"tag":"label","class":"form-label","for":"title","text":"Başlık"},
				{"tag":"div" ,"class":"input-group" 
					,"child":
					[ 
						{"tag":"input","id":"title","class":"form-control","name":"title"}
					]
				},
				{"tag":"label","class":"form-label","for":"content","text":"İçerik"},
				{"tag":"div","class":"input-group w-100","style":"margin-bottom:0" 
					,"child":
					[  
						{"tag":"textarea","id":"content","class":"form-control",editor:"ckeditor","name":"content"}
					]
				}
			]}
		]

var taskModals = new TaskModals("template-html","admin"); 
taskModals.setModalBody(bodyHtml);
	//taskModals.setEditorSize("md");
	//taskElements.appendElements(document.getElementById("popups"),buttons);
	//taskElements.createElements(document.getElementById("popups"),bodyHtml)  

	//taskElements.setElement();
	
taskModals.setEditorSize("fullscreen");
taskModals.doneResultChangeEvent =(args)=>{
	getTemplateList.click();
}  


var getTemplateList = document.getElementById("get-template-html-list");
getTemplateList.addEventListener("click",(e)=>{ 
	var data = [];

	var request = $.ajax({
		url: new TaskUrls().concatBaseUrl("/admin/template-html/get-template-html-list"),
		type: "POST",
		data: data
	});  
	request.done(function( e ) { 
		if (!e) {return}
		var result = JSON.parse(e);
		var jsonData=[];

		result.forEach((item)=>{
			jsonData.push({"tag":"a","href":"#","class":"list-group-item list-group-item-action"/* dropdown-toggle"*/,"role":"button","id":item["id"],"data-bs-toggle":"dropdown","aria-expanded":"false" 
							  ,"child":[{"tag":"div","class":"d-flex w-100 justify-content-between"
										  	,"child":[
										  		 { "tag":"h5" ,"class":"mb-1 text-truncate","text":item["title"]}, 
										  		]},
								  		//{"tag":"p","class":"mb-1 text-truncate","style":"max-width:1250px","text":item["title"]},
								  /*{"tag":"small","text":"[Eklenme :  , Düzenleme :]"}*/
								  	   ]
							} 
							,{"tag":"ul", class:"dropdown-menu dropdown-menu-end","aria-labelledby":item["id"]
								,"child":[
									{"tag":"li"
										,"child":[
											{"tag":"span", "class":"dropdown-item-text fw-bold fst-italic bg-light text-truncate","text":item["title"]}]},

									{"tag":"li"
										,"child":[
											{"tag":"span", "class":"dropdown-item","href":"#"
											,"data-bs-toggle":"modal","data-bs-target":"#template-html","data-bs-task":"remove","data-bs-id":item["id"],"data-bs-title":item["title"],"text":"Sil"}]},
									{"tag":"li"
										,"child":[
											{"tag":"a", "class":"dropdown-item","href":"#"
											,"data-bs-toggle":"modal","data-bs-target":"#template-html","data-bs-task":"update","data-bs-id":item["id"],"text":"Düzenle"}]},
									{"tag":"li"
										,"child":[
											{"tag":"a", "class":"dropdown-item","href":"#"
											,"data-bs-toggle":"modal","data-bs-target":"#template-html","data-bs-task":"preview","data-bs-id":item["id"],"text":"Önizleme"}]},
								]
							});
		});

		document.getElementById("template-html-content").innerHTML="";
		js.createElements(document.getElementById("template-html-content"),jsonData); 
		
	});
	request.fail(function( jqXHR, textStatus ) {
		alert( "Request failed: " + textStatus );
	}); 

});