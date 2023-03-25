//import AutoImage from '../node_modules/@ckeditor/ckeditor5-image/src/autoimage.js';

var editor;

ClassicEditor
    .create( document.querySelector( '#editor' ) ), {
        plugins: [ , AutoImage ]
    }
    .then( newEditor => {
        editor = newEditor;
    } )
    .catch( error => {
        console.error( error );
    } );
