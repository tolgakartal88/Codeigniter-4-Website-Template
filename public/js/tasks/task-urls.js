"use strict"

export default class TaskUrls{

	constructor(){

	}

	getLinkFormat(text){
		let trMap = {
			'ç':'c',
			'ğ':'g',
			'ş':'s',
			'ü':'u',
			'ı':'i',
			'ö':'o',
			'Ç':'C',
			'Ğ':'G',
			'Ş':'S',
			'Ü':'U',
			'İ':'I',
			'Ö':'O'

		};

		for(let key in trMap) {
			text = text.replace(new RegExp('['+key+']','g'), trMap[key]);
		} 

		text=text.toString()
		.replace(/[^-a-zA-Z0-9\s]+/ig, '')
		.trim() // remove non-alphanumeric chars
		.replace(/\s/gi, "-") // convert spaces to dashes
		.replace(/[-]+/gi, "-") // trim repeated dashes
		.toLowerCase();
		text = text.toLowerCase();
		return text;
	}

	concatBaseUrl(url){ 
		let folderName ="/Codeigniter-4-Website-Template" 
		return window.location.origin + folderName + url
	}
} 
