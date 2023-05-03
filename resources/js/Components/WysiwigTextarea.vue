<script setup>
import Editor from '@tinymce/tinymce-vue';

const config = {
  plugins: [
    'fullscreen', 'template', 'code', 'image', 'preview', 'media'
  ],
  toolbar1: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | code',
  toolbar2: 'customBtn | media | image',
  setup(editor) {
    editor.ui.registry.addButton('customBtn', {
      text: 'custon btn',
      onAction: () => {
        let timestamp = new Date().getTime();
        editor.insertContent(`<p id="callbackform-${timestamp}">[ФОРМА ОБРАТНОЙ СВЯЗИ]</p><p>&nbsp;</p>`);
      },
    });
  },
  language: 'ru',
  content_style: "p[id^='callbackform-'] { border: 1px solid #000; }",
  // images_upload_url: route('images.index'),
  file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    /*
      Note: In modern browsers input[type="file"] is functional without
      even adding it to the DOM, but that might not be the case in some older
      or quirky browsers like IE, so you might want to add it to the DOM
      just in case, and visually hide it. And do not forget do remove it
      once you do not need it anymore.
    */

    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.onload = function () {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
        var id = 'blobid' + (new Date()).getTime();
        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };

    input.click();
  },
}

defineProps({
  form: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <Editor :init="config" v-model="form.content" tinymce-script-src="/js/tinymce/tinymce.min.js" />
</template>
