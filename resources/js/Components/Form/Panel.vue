<script setup>
defineProps({
    label: String
});
</script>
<template>
    <div class="mb-8 px-8 pt-8 pb-4 bg-white rounded-md shadow max-w-5xl">
        <slot />
    </div>
</template>