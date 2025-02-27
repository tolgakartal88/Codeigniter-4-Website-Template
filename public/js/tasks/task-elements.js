"use strict" 

import TaskUrls from "./task-urls.js";
import "../../ckeditor/ckeditor.js";
import "../../ckeditor/config.js";

export default class TaskElements{

	#SPACE_CHAR=" ";
	#NONE="";
	rootElement={};
	ckeditor={};
	ckeditorData={};
	templatesHtml ={}

	constructor(){
		//this.#x();
	}

	rootEvent=(e)=>{
		alert("event");
	}

	appendElements = (root,elements)=>{ 
		var elems={}; 

		elements.forEach((element)=>{ 
			elems = document.createElement(element.tag);
			if (!!elements.classList && !!elements.class && element.classList !=="undefined") {
				elems.classList.add(...element.class.split(this.#SPACE_CHAR));
			}
			Object.keys(element).forEach(e=>{ 
				if (Object.keys(element).indexOf(e)>0 && !!element[e] ) {   
					switch(e){
						case "input": 
						switch(element.getAttribute("type")){
							case "checkbox":
							if(data[key]=="1")
								element.setAttribute("checked","checked");
							break;
							default: 
							element.value=data[key];
							break;
						} 
						break
						case "child":
						this.appendElements(elems,element[e]);
						break;
						case "text":
						elems.innerText=element[e];
						break; 
						default:
						elems.setAttribute(e,element[e]);
					}
				}
			}) 
			root.appendChild(elems);
			this.rootElement=root;

		});	 
		
	} 	

	checkCKEditor(root){
		let cthis = this;
		if (root==null) { return}
		var ck = root.querySelectorAll("[editor=ckeditor]");
		if (ck!=="undefined"){ 
			ck.forEach((item)=>{ 
				this.ckeditor[item.id]=CKEDITOR.replace(item.id,{
					toolbarGroups: [
					{ name: 'document',    groups: [ 'mode', /*'document'*/, 'doctools' ] },
				    { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
				    { name: 'editing',     groups: [ 'find', 'selection'/*, 'spellchecker'*/ ] },
				    /*{ name: 'forms' },*/
				    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ,"0"] },
				    '/',
				    { name: 'paragraph',   groups: [ 'list', 'indent', /*'blocks',*/ 'align', 'bidi' ] },
				    { name: 'links' },
				    { name: 'insert' },
				    '/',
				    { name: 'styles' },
				    { name: 'colors' },
				    { name: 'tools' },
				    { name: 'others' },
					],  
					allowedContent:true,
					extraAllowedContent :["div[class]","i(*)"],
					fillEmptyBlocks:false,
					breakBeforeOpen:false,
					breakAfterOpen:false,
					breakBeforeClose:false,
					breakAfterClose:false,
					on: {
						pluginsLoaded: function() {
							var editor = this, 
							config = editor.config; 
							editor.ui.addRichCombo( 'my-combo', {
								label: 'Şablon Sayfalar',
								title: 'Şablon Sayfalar',
								toolbar: 'basicstyles,0',
								width:"100%",
								height:"100%",

								panel: {               
									css: [ CKEDITOR.skin.getPath( 'editor' ) ].concat( config.contentsCss ),
									multiSelect: false,
									attributes: { 'aria-label': 'My Dropdown Title' }
								},

								init: function() {    
									//this.startGroup( 'My Dropdown Group #1' ); 
									var btns =cthis.#ckEditorButtons() 
									btns.forEach((item)=>{

										if (item.groupName!="") {
											this.startGroup( item.groupName );
										}
										this.add( item.buttons.htmlText, item.buttons.buttonText );
									})                

								},

								onClick: function( value ) {
									editor.focus();
									editor.fire( 'saveSnapshot' ); 
									editor.insertHtml( value ); 

									editor.fire( 'saveSnapshot' );
								}
							} );        
						}        
					}
				} );  
			});
		}
	}

	/**
	 *
	 * @returns {Array}
	 */
	#ckEditorButtons=()=>{
		var xhr = new XMLHttpRequest();
		var arr=[];
		xhr.open("POST",new TaskUrls().concatBaseUrl("/admin/template-html/get-template-html-list"),false); 
		//xhr.responseType='json';
		xhr.send(null);
		if(xhr.status===200){
			var result= JSON.parse(xhr.response);

			result.forEach((item)=>{
				arr.push({groupName:"",buttons:{buttonText:item.title,htmlText:item.content.replace(/\r?\n|\r/g, "")}})
			})
		} 
		return arr;
	}
	 
	createElements= (root,elements)=>{
		if (!!root) {
			root.innerHTML=this.#NONE;
			this.appendElements(root,elements);
		}
	}

	setObjToSelectIdValue(obj=[{id:-1,title:"Seçiniz"}]){
		let resultObj = [];
		for(const index in obj){
			resultObj.push({tag:"option",class:"option",value:obj[index].id,text:obj[index].title});
		}

		return resultObj;
	} 

	setElement(){
		let e = this.rootElement.querySelector("[name=title]");
		e.value="123132132123";
	}

	getFormElementData(formElement){
		var formData = new FormData();
		let fElements = [].slice.call(formElement)
		fElements.forEach((element)=>{
			switch(element.tagName.toLowerCase()){
				case "input": 
				switch(element.getAttribute("type")){
					case "checkbox":
					formData.append(element.name,element.checked);
					break;
					case "file":
					let filesElement = [].slice.call(element.files);
					for(const index in filesElement){
						formData.append("file_"+index,filesElement[index]);
					} 

					break;
					default: 
					formData.append(element.name,element.value);
					break;
				} 
				break
				case "select":
				formData.append(element.name,element.value);
				break; 
				case "textarea":
				formData.append(element.name,CKEDITOR.instances[element.id].getData());
				break
				default:
				break;
			}
		});
		return formData;
	}

	

	setFormElementData(formElements,data){
		Object.keys(data).forEach((key)=>{
			var element = formElements.querySelector("[name="+key+"]");
			if (!!element)
				switch(element.tagName.toLowerCase()){
					case "input":
					if (element.getAttribute("editor")=="ckeditor") {  
					}
					else
					{
						switch(element.getAttribute("type")){
							case "checkbox":
							if(data[key]=="1")
								element.setAttribute("checked","checked");
							break;
							case "image":
								element.setAttribute("src","data:image/png;base64,"+data[key])
							break
							default: 
							element.value=data[key];
							break;
						}
					}
					break
					case "textarea": 
					let editor = CKEDITOR.instances[element.id]
					editor.setData(data[key]);
					break;
					case "select":
					element.value=data[key];
					break; 
					default:
					break;
				} 
			})
		
	}

	addSearchButton(root,searchBoxHtml,listGroupClass,listElementClass){
		this.createElements(root,searchBoxHtml);
		let input = root.querySelector("input");
		var eventHandler = function(e){
			let listItems = document.getElementsByClassName(listGroupClass)[0].querySelectorAll("."+listElementClass);
			let listElements = [].slice.call(listItems)
			listElements.forEach((item)=>{
				if (item.textContent.toLowerCase().search(input.value.toLowerCase())<0) {
					item.classList.add("d-none");
					item.classList.remove("d-block");
				}
				else{
					item.classList.add("d-block");
					item.classList.remove("d-none"); 
				}
			});
		}

		input.addEventListener("search",eventHandler);
		input.addEventListener("keyup",eventHandler);

	}
}
const aElements = function(e){alert("test export"+e)};

export{aElements};