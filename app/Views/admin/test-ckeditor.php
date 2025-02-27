<?= $this->extend('defaults/default-admin') ?> 

<?= $this->section('header-script') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="forms">

</div>

<?= $this->endSection() ?>

<?= $this->section('footer-script') ?>
<script type="module">
	import TaskUrls from "../public/js/tasks/task-urls.js";
	import TaskElements from "../public/js/tasks/task-elements.js";
	var ckeditor = [];

	var formElements = document.getElementById("forms");
	var bodyHtml = [{tag:"form",class:"",child:[ 
						{tag:"textarea",editor:"ckeditor",id:"content0", name:"content0"}, 
						{tag:"textarea",editor:"ckeditor",id:"content1", name:"content1"}, 
						{tag:"textarea",editor:"ckeditor",id:"content2", name:"content2"}, 
						{tag:"textarea",editor:"ckeditor",id:"content3", name:"content3"}, 
						{tag:"textarea",editor:"ckeditor",id:"content4", name:"content4"}, 
						{tag:"textarea",editor:"ckeditor",id:"content5", name:"content5"}, 
					]}
	];

	var taskElements = new TaskElements();
	taskElements.createElements(formElements,bodyHtml);
	taskElements.checkCKEditor(formElements);

	
</script>
<?= $this->endSection() ?>