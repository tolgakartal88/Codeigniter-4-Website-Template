import TaskElements from "../../tasks/task-elements.js";
import TaskUrls from "../../tasks/task-urls.js";

$(document).ready(function(e){
	var form = document.getElementById("login-form");
	var data = new Object();

	$("#login-form").on("submit",function(e){
		data.username = form.querySelector("input[name=username]").value;
		data.password = form.querySelector("input[name=password]").value;
		var request = $.ajax({
			url: new TaskUrls().concatBaseUrl("/log/in"),
			type: "POST",
			data: data
		});


		request.done(function( msg ) {
			var result = JSON.parse(msg);
			if (!result["error"]) 
			{
				window.location.replace( new TaskUrls().concatBaseUrl("/user/profile/"));					
			}
			else
			{ 
				var valArea = document.getElementById("validation-area");
				var errorBody = [{"tag":"ol","class":"list-group-numbered alert alert-danger","text":"Hata:",child:[]}]
				valArea.innerHTML=""; 
				Object.keys(result["data"]).forEach((key)=>{
					errorBody[0].child.push({"tag":"li","class":"align-item-center","text":result["data"][key]}) 
				})
				new TaskElements().createElements(valArea,errorBody);  
			}
		});
		e.preventDefault();
	});

});