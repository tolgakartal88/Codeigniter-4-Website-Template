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
createSearchBox.addSearchButton(searchBox,searchBoxHtml,"courses-content","list-group-item");

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
				selectOptions= taskElements.setObjToSelectIdValue(xhr.response);
				var bodyHtml=[
						{"tag":"form", "child":[
							{"tag":"input","id":"id","class":"hidden","name":"id","type":"hidden"},
							{"tag":"label","class":"form-label","for":"course-list","text":"Kategori"},
							{"tag":"div","class":"input-group" 
								,"child":
								[  
									{"tag":"select","id":"course-list","class":"form-select course-list","name":"menu_id","child":selectOptions}
								]
							},
							{"tag":"label","class":"form-label","for":"title","text":"Başlık"},
							{"tag":"div" ,"class":"input-group" 
								,"child":
								[ 
									{"tag":"input","id":"title","class":"form-control","name":"title","value":"test"}
								]
							},
							{"tag":"label","class":"form-label","for":"description","text":"Açıklama"},
							{"tag":"div","class":"input-group" 
								,"child":
								[  
									{"tag":"input","id":"description","class":"form-control","name":"description","value":"test"}
								]
							},
							{"tag":"label","class":"form-label","for":"url","text":"Url"},
							{"tag":"div", "class":"input-group","child":
								[ 
									{"tag":"div","class":"input-group-text p-1","child":[
										{"tag":"input","type":"checkbox","id":"change-url","class":"form-check-input ms-1","name":"change_url", "checked":"checked"},
										{"tag":"label","class":"form-label ms-2 mt-2","for":"change-url","text":"course / "},
									]},
									{"tag":"input","type":"text","id":"url","class":"form-control","name":"url","readonly":"readonly"}
								]
							},
							{"tag":"label","class":"form-label w-100","for":"content","text":"İçerik"},
							{"tag":"div","class":"input-group" 
								,"child":
								[  
									{"tag":"textarea","id":"content","class":"form-control",editor:"ckeditor","name":"content"}
								]
							}, 
							{"tag":"label","class":"form-label","for":"row_order","text":"Sıra"},
							{"tag":"div","class":"input-group" 
								,"child":
								[  
									{"tag":"input", "type":"number", "id":"row_order","class":"form-control","name":"row_order","value":"0"}
								]
							},
							{"tag":"label","class":"form-label","for":"tags","text":"Etiketler"},
							{"tag":"div","class":"input-group" 
								,"child":
								[  
									{"tag":"input", "type":"text", "id":"tags","class":"form-control","name":"tags","value":""}
								]
							},
							{"tag":"div","class":"form-check m-3" 
								,"child":
								[  
									{"tag":"input","type":"checkbox","id":"active","class":"form-check-input","name":"active"},
									{"tag":"label","class":"form-check-label","for":"active","text":"Aktif"},
								]
							}
						]}
						
					]

				var taskModals = new TaskModals("course","admin"); 
				taskModals.setModalBody(bodyHtml); 
				
					//taskModals.setEditorSize("md");
					//taskElements.appendElements(document.getElementById("popups"),buttons);
					//taskElements.createElements(document.getElementById("popups"),bodyHtml)  

					//taskElements.setElement();
					
				taskModals.setEditorSize("fullscreen");
				taskModals.doneResultChangeEvent =(args)=>{
					getCourseList.click();
				}   
				taskModals.modalLoadedExport = (e)=>{
					var changedUrl = document.getElementById("change-url");
					var title = document.getElementById("title");
					var url = document.getElementById("url");

					if (!!title) {
						title.addEventListener("keyup",(e)=>{
							if(changedUrl.checked){
								url.value = new TaskUrls().getLinkFormat(title.value)
							}
						});
					}
					
					if (!!changedUrl) {
						changedUrl.addEventListener("change",(e)=>{
							if (e.currentTarget.checked) {
								url.readOnly=true;
							}
							else
							{
								url.readOnly=false;
							}
						})
					}
				}
			}
		} 


	var js = new TaskElements();


	/*
	var data = new Object();
	data.seperator = false;
	var request = $.ajax({
			url: new TaskUrls().concatBaseUrl("/admin/categories/get-category-list"),
			type: "POST",
			data: data
		});  
		request.done(function( e ) { 
			if (!e) {return}
			var result = JSON.parse(e);

			result.forEach((item)=>{
				courseList.push({"tag":"option","value":item["id"],"text":item["title"]}); 
			}); 
			js.createElements(modalTask.elements.editor.body.querySelector(".course-list"),courseList);
		});
		request.fail(function( jqXHR, textStatus ) {
			alert( "Request failed: " + textStatus );
		}); 
	*/

	var getCourseList = document.getElementById("get-course-list");
	getCourseList.addEventListener("click",(e)=>{ 
		var data = [];

		var request = $.ajax({
			url: new TaskUrls().concatBaseUrl("/admin/course/get-course-list"),
			type: "POST",
			data: data
		});  
		request.done(function( e ) { 
			if (!e) {return}
			var result = JSON.parse(e);
			var jsonData=[];

			result.forEach((item)=>{
				jsonData.push({"tag":"a","href":"#","class":"list-group-item list-group-item-action","role":"button","id":item["id"],"data-bs-toggle":"dropdown","aria-expanded":"false" 
								  ,"child":[{"tag":"div","class":"d-flex w-100 justify-content-between"
											  	,"child":[
											  		 { "tag":"h5" ,"class":"mb-1 text-truncate" ,"text":item["title"]}
											  		,{ "tag":"small","child":[{"tag":"i","text":item["category_title"]}]}
											  		] 
											},
								{"tag":"p","class":"mb-1 text-truncate","style":"max-width:1250px","text":item["description"]},
								{"tag":"small",class:"d-flex flex-row-reverse","text":"Eklenme : "+item["insert_date_ellapsed"],"title":item["insert_date_str"],child:[{tag:"i",class:"fas fa-calendar me-2"}]},
									  	   ]
								} 
								,{"tag":"ul", class:"dropdown-menu dropdown-menu-end","aria-labelledby":item["id"]
									,"child":[
										{"tag":"li"
											,"child":[
												{"tag":"span", "class":"dropdown-item-text fw-bold fst-italic bg-light text-truncate","text":item["title"]}]},

										{"tag":"li"
											,"child":[
												{"tag":"a", "class":"dropdown-item","href":"#"
												,"data-bs-toggle":"modal","data-bs-target":"#course","data-bs-task":"remove","data-bs-title":item["title"],"data-bs-id":item["id"],"text":"Sil"}]},
										{"tag":"li"
											,"child":[
												{"tag":"span", "class":"dropdown-item action-edit","href":"#"
												,"data-bs-toggle":"modal","data-bs-target":"#course","data-bs-task":"update","data-bs-title":item["title"],"data-bs-id":item["id"],"text":"Düzenle"}]}
									]
								});
			});

			document.getElementById("courses-content").innerHTML="";
			js.createElements(document.getElementById("courses-content"),jsonData); 
		});
		request.fail(function( jqXHR, textStatus ) {
			alert( "Request failed: " + textStatus );
		});
	}); 


})

