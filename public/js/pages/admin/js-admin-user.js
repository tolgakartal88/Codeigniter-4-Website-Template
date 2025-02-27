
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
createSearchBox.addSearchButton(searchBox,searchBoxHtml,"users-content","list-group-item");

var js = new TaskElements();

var bodyHtml=[
			{"tag":"form", "child":[
				{"tag":"input","id":"id","class":"hidden","name":"id","type":"hidden"},
				{"tag":"div" ,"class":"input-group text-left" 
					,"child":
					[ 
						{"tag":"input","id":"photo","class":"img-thumbnail p-1","style":"width:10rem; height:10rem","disabled":"false","name":"photo","type":"image"},
					]
				},
				
				{"tag":"label","class":"form-label","for":"first_name","text":"Adı"},
				{"tag":"div" ,"class":"input-group" 
					,"child":
					[ 
						{"tag":"input","id":"first_name","class":"form-control","name":"first_name"}
					]
				},
				{"tag":"label","class":"form-label","for":"last_name","text":"Soyadı"},
				{"tag":"div" ,"class":"input-group" 
					,"child":
					[ 
						{"tag":"input","id":"last_name","class":"form-control","name":"last_name"}
					]
				},
				{"tag":"label","class":"form-label","for":"username","text":"Kullanıcı Adı"},
				{"tag":"div" ,"class":"input-group" 
					,"child":
					[ 
						{"tag":"input","id":"username","class":"form-control","name":"username"}
					]
				},
				{"tag":"label","class":"form-label","for":"password","text":"Şifre"},
				{"tag":"div" ,"class":"input-group" 
					,"child":
					[ 
						{"tag":"input","id":"password","type":"password","class":"form-control","name":"password"},
						{"tag":"i","class":"fas fa-eye fa-lg p-3"},
					]
				},
				{"tag":"div","class":"form-check form-switch m-3" 
					,"child":
					[  
						{"tag":"input","type":"checkbox","id":"is_admin","class":"form-check-input","name":"is_admin"},
						{"tag":"label","class":"form-check-label","for":"is_admin","text":"Admin Kullanıcısı"},
					]
				},
				{"tag":"div","class":"form-check form-switch m-3" 
					,"child":
					[  
						{"tag":"input","type":"checkbox","id":"active","class":"form-check-input","checked":"checked","name":"active"},
						{"tag":"label","class":"form-check-label","for":"active","text":"Aktif"},
					]
				}
			]}
		]

var taskModals = new TaskModals("user","admin"); 
taskModals.setModalBody(bodyHtml);
	//taskModals.setEditorSize("md");
	//taskElements.appendElements(document.getElementById("popups"),buttons);
	//taskElements.createElements(document.getElementById("popups"),bodyHtml)  

	//taskElements.setElement();
	
taskModals.setEditorSize("md");
taskModals.doneResultChangeEvent =(args)=>{
	getUserList.click();
}  

taskModals.modalLoadedExport=(e)=>{
	const passbtn = e.currentTarget.querySelector("input[name=password]")
	if (!!passbtn) {
		const passShowHide = passbtn.nextElementSibling;
		const passInput = e.currentTarget.querySelector("input[name=password]");
		if (!!passShowHide) {
			passShowHide.addEventListener("pointerdown",(e)=>{ 
				passShowHide.classList.remove(...passShowHide.classList);
				passInput.removeAttribute("type"); 
				passShowHide.classList="fas fa-eye-slash fa-lg p-3" 
			}) 
			passShowHide.addEventListener("pointerup",(e)=>{
				passInput.setAttribute("type","password");
				passShowHide.classList.remove(...passShowHide.classList);
				passShowHide.classList="fas fa-eye fa-lg p-3" 
			})
		}
	}
};

var getUserList = document.getElementById("get-user-list");
getUserList.addEventListener("click",(e)=>{ 
	var data = [];

	var request = $.ajax({
		url: new TaskUrls().concatBaseUrl("/admin/user/get-user-list"),
		type: "POST",
		data: data
	});  
	request.done(function( e ) { 
		if (!e) {return} 
		var result = JSON.parse(e);

		var jsonData=[];

		result.forEach((item)=>{
			jsonData.push({"tag":"a","href":"#","class":"list-group-item list-group-item-action"/* dropdown-toggle"*/,"role":"button","id":item["id"],"data-bs-toggle":"dropdown","aria-expanded":"false" 
							  ,"child":[
								  		{"tag":"div","class":"d-flex w-100 justify-content-between"
										  	,"child":[
										  		 { "tag":"h5" ,"class":"mb-1 text-truncate","text":item["username"]}
										  		,{ "tag":"small","child":[{"tag":"i","text":(item["is_admin"]=="1"?"Admin":"")}]}
										  		] 
										},
								  		{"tag":"img","class":"img-fluid","style":"width:5rem;","src":"data:image/png;base64,"+item["photo"]},
								  		{"tag":"p","class":"mb-1 text-truncate","style":"max-width:1250px","text":item["first_name"]+' '+item["last_name"]},
								  	   ]
							} 
							,{"tag":"ul", class:"dropdown-menu dropdown-menu-end","aria-labelledby":item["id"]
								,"child":[
									{"tag":"li"
										,"child":[
											{"tag":"span", "class":"dropdown-item-text fw-bold fst-italic bg-light text-truncate","text":item["username"]}]},

									{"tag":"li"
										,"child":[
											{"tag":"span", "class":"dropdown-item","href":"#"
											,"data-bs-toggle":"modal","data-bs-target":"#user","data-bs-task":"remove","data-bs-id":item["id"],"data-bs-title":item["username"],"text":"Sil"}]},
									{"tag":"li"
										,"child":[
											{"tag":"a", "class":"dropdown-item","href":"#"
											,"data-bs-toggle":"modal","data-bs-target":"#user","data-bs-task":"update","data-bs-id":item["id"],"text":"Düzenle"}]}
								]
							});
		});

		document.getElementById("users-content").innerHTML="";
		js.createElements(document.getElementById("users-content"),jsonData); 
		
	});
	request.fail(function( jqXHR, textStatus ) {
		alert( "Request failed: " + textStatus );
	}); 

});