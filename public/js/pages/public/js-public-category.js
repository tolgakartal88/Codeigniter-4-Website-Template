import TaskElements from "../../tasks/task-elements.js";


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
createSearchBox.addSearchButton(searchBox,searchBoxHtml,"list-group","list-group-item");