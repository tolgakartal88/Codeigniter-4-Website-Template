
import TaskModals 	from "../../tasks/task-modals.js";
import TaskElements from "../../tasks/task-elements.js";
import TaskUrls 	from "../../tasks/task-urls.js";

var js = new TaskElements();

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
createSearchBox.addSearchButton(searchBox,searchBoxHtml,"categories-content","list-group-item");

var bodyHtml=[
			{"tag":"form", "child":[
				{"tag":"input","id":"id","class":"hidden","name":"id","type":"hidden"},
				{"tag":"label","class":"form-label","for":"title","text":"Başlık"},
				{"tag":"div" ,"class":"input-group" 
					,"child":
					[ 
						{"tag":"input","id":"title","class":"form-control","name":"title"}
					]
				},
				{"tag":"label","class":"form-label","for":"url","text":"Url"},
				{"tag":"div", "class":"input-group","child":
					[ 
						{"tag":"div","class":"input-group-text p-1","child":[
							{"tag":"input","type":"checkbox","id":"change-url","class":"form-check-input ms-1","name":"change_url", "checked":"checked"},
							{"tag":"label","class":"form-label ms-2 mt-2","for":"change-url","text":"category / "},
						]},
						{"tag":"input","type":"text","id":"url","class":"form-control","name":"url","readonly":"readonly"}
					]
				},
				{"tag":"label","class":"form-label","for":"category-order","text":"Menü Sırası"},
				{"tag":"div","class":"input-group" 
					,"child":
					[  
						{"tag":"input","id":"category-order","class":"form-control","type":"number","name":"row_order"}
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

var taskModals = new TaskModals("category","admin"); 
taskModals.setModalBody(bodyHtml);
	//taskModals.setEditorSize("md");
	//taskElements.appendElements(document.getElementById("popups"),buttons);
	//taskElements.createElements(document.getElementById("popups"),bodyHtml)  

	//taskElements.setElement();
	
taskModals.setEditorSize("md");
taskModals.doneResultChangeEvent =(args)=>{
	getCategoryList.click();
}  
/*
{"tag":"div","class":"form-check" 
			,"child":
			[  
				{"tag":"input","type":"checkbox","id":"accept","class":"form-check-input","name":"accept"},
				{"tag":"label","class":"form-check-label","for":"accept","text":"Accept"},
			]
		},
		{"tag":"label","class":"form-label","for":"category-list","text":"Liste"},
		{"tag":"div","class":"input-group" 
			,"child":
			[  
				{"tag":"select","id":"category-list","class":"form-select","name":"category-list"
				 ,"child":
				 	[
				 		{"tag":"option","value":1,"text":"Birinci"},
				 		{"tag":"option","value":2,"text":"İkinci"},
				 		{"tag":"option","value":3,"text":"Üçüncü"},
				 	]
				}
			]
		}
*/ 
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
var getCategoryList = document.getElementById("get-category-list");
getCategoryList.addEventListener("click",(e)=>{ 
	var data = [];

	var request = $.ajax({
		url: new TaskUrls().concatBaseUrl("/admin/category/get-category-list"),
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
										  		//,{ "tag":"small","child":[{"tag":"i","text":item["title"]}]}
										  		] 
										},
								  //{"tag":"p","class":"mb-1 text-truncate","style":"max-width:1250px"},
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
											,"data-bs-toggle":"modal","data-bs-target":"#category","data-bs-task":"remove","data-bs-id":item["id"],"data-bs-title":item["title"],"text":"Sil"}]},
									{"tag":"li"
										,"child":[
											{"tag":"a", "class":"dropdown-item","href":"#"
											,"data-bs-toggle":"modal","data-bs-target":"#category","data-bs-task":"update","data-bs-id":item["id"],"text":"Düzenle"}]}
								]
							});
		});

		document.getElementById("categories-content").innerHTML="";
		js.createElements(document.getElementById("categories-content"),jsonData);  
	});
	request.fail(function( jqXHR, textStatus ) {
		alert( "Request failed: " + textStatus );
	});
});