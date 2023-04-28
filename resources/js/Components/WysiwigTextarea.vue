<script setup>
import { onMounted } from 'vue';
onMounted(() => {
  tinymce.init({
    selector: '.WYSIWYG'
  })
})
</script>
<template>
    <textarea class="WYSIWYG"></textarea>
</template>