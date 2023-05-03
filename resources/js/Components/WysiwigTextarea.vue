<script setup>
import Editor from '@tinymce/tinymce-vue';

const config = {
  plugins: [
    'fullscreen', 'template', 'code', 'image', 'preview'
  ],
  toolbar1: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | code',
  toolbar2: 'customBtn',
  setup(editor) {
    editor.ui.registry.addButton('customBtn', {
      text: 'custon btn',
      onAction: () => {
        let timestamp = new Date().getTime();
        editor.insertContent(`<p id="callbackform-${timestamp}">[ФОРМА ОБРАТНОЙ СВЯЗИ]</p><p>&nbsp;</p>`);
      },
    });
  },
  content_style: "p[id^='callbackform-'] { border: 1px solid #000; }",
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
