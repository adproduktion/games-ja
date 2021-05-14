var editor = CKEDITOR.replace('editor',{height: 500});
//  AjexFileManager.init({returnTo: 'ckeditor', editor: editor});
editor.on( 'key', function( evt ) {
        $('.msg-info div').css('display', 'none');
        $('.msg-non-save').css('display', 'flex');
    
} );