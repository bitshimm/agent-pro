<script setup>
defineProps({
    label: String
});
</script>
<template>
    <div class="mb-8 px-8 pt-8 pb-4 bg-white rounded-md shadow max-w-5xl">
        <h1 class="text-xl font-bold text-slate-700 mb-5" v-if="label">
            {{ label }}
        </h1>
        <slot />
    </div>
</template>