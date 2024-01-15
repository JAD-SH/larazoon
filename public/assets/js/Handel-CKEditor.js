var editors = [];  
  function createEditor(element_id, editor_placeholder){
      return CKEDITOR.ClassicEditor.create(document.getElementById(element_id), {
          // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
          language: 'ar',
          toolbar: {
              items: [
                  'undo', 'redo', '|',
                  'bold', 'italic', 'strikethrough', 'underline', '|',
                  'fontColor', 'highlight', 'code', 'specialCharacters', '|',
                  'codeBlock', 'link', 'todoList', 'numberedList', 'insertTable', '|',
                  'horizontalLine', 'alignment', 'outdent', 'indent', 'selectAll', 'removeFormat', 
              ],
              shouldNotGroupWhenFull: true
          },
          placeholder: editor_placeholder,
          
          
          // Be careful with enabling previews
          // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
          
          // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
          link: {
              decorators: {
                  addTargetToExternalLinks: true,
                  defaultProtocol: 'https://',
                  toggleDownloadable: {
                      mode: 'automatic',
                      
                  }
              }
          },
          // The "super-build" contains more premium features that require additional configuration, disable them below.
          // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
          
          removePlugins: [
              // These two are commercial, but you can try them out without registering to a trial.
                  'ExportPdf',
                  'ExportWord',
              'CKBox',
              'CKFinder',
              'EasyImage',
              // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
              // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
              // Storing images as Base64 is usually a very bad idea.
              // Replace it on production website with other solutions:
              // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
              // 'Base64UploadAdapter',
              'RealTimeCollaborativeComments',
              'RealTimeCollaborativeTrackChanges',
              'RealTimeCollaborativeRevisionHistory',
              'PresenceList',
              'Comments',
              'TrackChanges',
              'TrackChangesData',
              'RevisionHistory',
              'Pagination',
              'WProofreader',
              // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
              // from a local file system (file://) - load this site via HTTP server if you enable MathType.
              'MathType',
              // The following features are part of the Productivity Pack and require additional license.
              'SlashCommand',
              'Template',
              'DocumentOutline',
              'FormatPainter',
              'TableOfContents'
          ]
      })
      .then(editor => {
          editors[element_id]  = editor;
      })
      .catch( error => {
          console.error('فعلت خطأ يا غالي');
      } );
  }

function ckeditor_ajax_function(){
    $(document).on( "click", ".ckeditor-ajax-submit", function(e) {
        e.preventDefault();
        let this_button=$(this);
        let data_editor_id=$(this).attr('data-editor-id');
        let data_editor_name=$(this).attr('data-editor-name');
        let form =  this_button.closest('form');
        let formActionUrl = form.attr('action');
        let textAreaEle= document.createElement("textarea");
        textAreaEle.setAttribute('name',data_editor_name);
        textAreaEle.setAttribute('class','d-none');
        form.append(textAreaEle);
        let text_ele = editors[data_editor_id].getData();//for test
        $(`textarea[name="${data_editor_name}"]`).text(text_ele);
        let type = form.attr('method');
        let formData=new FormData($(form)[0]);
        $.ajax({
            url: formActionUrl,
            type: type,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success:function(data) {
                if($(`textarea[name="${data_editor_name}"]`) !== null){
                $(`textarea[name="${data_editor_name}"]`).remove();
                }
                ajax_success_view(data,this_button);
            },
            error:function(reject) {
            let error_alert = Array.from($('div[id$="_error"]'));
            if(error_alert.length > 0){
                error_alert.forEach(element => {
                $(element).fadeOut(200);
                });
            }
            if($(`textarea[name="${data_editor_name}"]`) !== null){
                $(`textarea[name="${data_editor_name}"]`).remove();
            }
            var response=$.parseJSON(reject.responseText);
            $.each(response.errors, function(key, val){
                $('[id=' + key + '_error]').fadeIn(500).text(val[0]);
            });
            },
            beforeSend:function() {
            }
        });
    });
}