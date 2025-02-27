"use strict"

class TaskClipboard{

	constructor(){

	}

	async setCopyClipBoard(value){
		if (navigator.clipboard && window.isSecureContext) {
			await navigator.clipboard.writeText(value)
		}
		else{
			const tarea = document.createElement("textarea");
			tarea.value=value;
			tarea.style.position="absolute"; 
			document.body.prepend(tarea);
			tarea.select();
			try{
				document.execCommand("copy")
			}
			catch(ex){
				console.error(ex)
			}
			finally{
				tarea.remove();
			}
		}
	}
}