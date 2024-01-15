<script setup>
const props = defineProps({
    id: String,
    width: Number,
    height: Number,
    fill: String,
});
</script>
<template>
    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        :class="fill" class="inline-block" :style="{ width: width ?? 24 + 'px', height: height ?? 24 + 'px'  }">
        <use :xlink:href="'#' + id" />
    </svg>
</template>