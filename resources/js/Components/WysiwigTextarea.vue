<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
defineProps({
  modelValue: {
    type: String,
    required: true,
  },
});
defineEmits(['update:modelValue']);
const textarea = ref('null');

onMounted(() => {
  tinymce.init({
    selector: '.WYSIWYG'
  });
  if (textarea.value.hasAttribute('autofocus')) {
    textarea.value.focus();
  }
  setInterval(function () {
    console.log(modelValue);
  }, 1000);
});
function logTextarea() {
  
}
onUnmounted(() => {
  tinymce.remove();
})
</script>
<template>
  <textarea class="WYSIWYG" :value="modelValue" ref="textarea"></textarea>
</template>