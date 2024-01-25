<script setup>
const props = defineProps({
    id: String,
    width: Number,
    height: Number,
	currentColor: String,
});
</script>
<template>
    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        class="inline-block" :class="currentColor" :style="{ width: width ?? 24 + 'px', height: height ?? 24 + 'px'  }">
        <use :xlink:href="'#' + id" />
    </svg>
</template>