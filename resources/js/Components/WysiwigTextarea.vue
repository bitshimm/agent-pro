<script setup>
import Editor from '@tinymce/tinymce-vue';
import { ref } from 'vue';

const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
  const xhr = new XMLHttpRequest();
  xhr.withCredentials = false;
  xhr.open('POST', route('tinymce.upload'));
  const token = document.head.querySelector("[name=csrf-token]").content;
  xhr.setRequestHeader("X-CSRF-Token", token);
  xhr.upload.onprogress = (e) => {
    progress(e.loaded / e.total * 100);
  };

  xhr.onload = () => {

    if (xhr.status === 403) {
      reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
      return;
    } else if (xhr.status < 200 || xhr.status >= 300) {
      reject('HTTP Error: ' + xhr.status);
      return;
    }

    const json = JSON.parse(xhr.responseText);

    if (!json || typeof json.location != 'string') {
      reject('Invalid JSON: ' + xhr.responseText);
      return;
    }
    resolve(json.location);
  };

  xhr.onerror = () => {
    reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
  };

  const formData = new FormData();
  formData.append('image', blobInfo.blob(), blobInfo.filename());

  xhr.send(formData);
});

const config = {
  height: 800,
  plugins: [
    'fullscreen', 'code', 'image', 'preview', 'media', 'link'
  ],
  toolbar1: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | media image | code',
  toolbar2: 'link',
  toolbar3: 'customBtn |',
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
  automatic_uploads: true,
  relative_urls: false,
  images_upload_handler: example_image_upload_handler,
  file_picker_callback(callback, value, meta) {
    let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
    let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight

    tinymce.activeEditor.windowManager.openUrl({
      url: '/filemanager',
      title: 'Файловый менеджер',
      width: x * 0.8,
      height: y * 0.8,
      onMessage: (api, message) => {
        callback(message.content, { text: message.text })
      }
    })
  }
}
const showModal = ref(false)
defineProps({
  form: {
    type: Object,
    required: true,
  },
  label: String,
  error: String,
});
</script>

<template>
  <div class="form-item wysiwig-textarea" :class="{ error: error }">
    <span class="form-label">{{ label }}:</span>
    <div class="form-modal-btn" @click="showModal = true">Открыть окно</div>
    <div v-if="error" class="form-error">{{ error }}</div>
    <div class="form-modal-wrapper" v-if="showModal">
      <div class="form-modal">
        <div class="form-modal-header">{{ label }} <span class="form-modal-close" @click="showModal = false"><i
              class="fa-solid fa-xmark"></i></span></div>
        <div class="form-modal-content">
          <Editor :init="config" v-model="form.content" tinymce-script-src="/js/tinymce/tinymce.min.js"
            class="form-textarea" />
        </div>
      </div>
    </div>
  </div>
</template>
