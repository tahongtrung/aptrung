/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    config.enterMode = CKEDITOR.ENTER_BR;
	config.filebrowserBrowseUrl = 'http://themes.webspixel.com/aptrung/assets/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = 'http://themes.webspixel.com/aptrung/assets/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = 'http://themes.webspixel.com/aptrung/assets/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = 'http://themes.webspixel.com/aptrung/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = 'http://themes.webspixel.com/aptrung/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = 'http://themes.webspixel.com/aptrung/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
