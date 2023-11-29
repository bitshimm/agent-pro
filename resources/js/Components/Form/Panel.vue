<script setup>
defineProps({
    label: String
});
</script>
<template>
    <div class="mb-8 px-8 pt-8 pb-4 bg-white rounded-md shadow w-full">
        <slot />
    </div>
</template>