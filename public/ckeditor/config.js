/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

 CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'tr';
	config.width='100%'
	config.height = "25rem"
    config.versionCheck = false;
    config.allowedContent = true;
    config.extraAllowedContent ="*(*);*{*}"; 
    /*
	config.toolbar=[
	['Source',"-","Bold","Italic"]

	]; 
	config.toolbarGroups = [
    { name: 'document',    groups: [ 'mode', 'document', 'doctools' ] },
    { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
    { name: 'editing',     groups: [ 'find', 'selection'/*, 'spellchecker' ] },
    { name: 'forms' },
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ,"0"] },
    '/',
    { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
    { name: 'links' },
    { name: 'insert' },
    '/',
    { name: 'styles' },
    { name: 'colors' },
    { name: 'tools' },
    { name: 'others' },
    /*{ name: 'about' }
    ];
	//config.uiColor = '#AADC6E';
	config.versionCheck = false;
    config.on ={
        pluginsLoaded: function() {
            var editor = this,
            config = editor.config;

            editor.ui.addRichCombo( 'my-combo', {
                label: 'My Dropdown Label',
                title: 'My Dropdown Title',
                toolbar: 'basicstyles,0',

                panel: {               
                    css: [ CKEDITOR.skin.getPath( 'editor' ) ].concat( config.contentsCss ),
                    multiSelect: false,
                    attributes: { 'aria-label': 'My Dropdown Title' }
                },

                init: function() {    
                    this.startGroup( 'My Dropdown Group #1' );
                    this.add( 'foo', 'Foo!' );
                    this.add( 'bar', 'Bar!' );                    

                    this.startGroup( 'My Dropdown Group #2' );
                    this.add( 'ping', 'Ping!' );
                    this.add( 'pong', 'Pong!' );                    

                },

                onClick: function( value ) {
                    editor.focus();
                    editor.fire( 'saveSnapshot' );

                    editor.insertHtml( value );

                    editor.fire( 'saveSnapshot' );
                }
            } );        
        }
    }        */
}