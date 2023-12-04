<script setup>
defineProps({
    label: {
        type: String,
    },
});
</script>
<script>
export default {
    inheritAttrs: false,
}
</script>
<template>
    <div class="flex flex-wrap py-4 px-1">
        <button type="submit" class="btn_indigo ml-auto" v-bind="$attrs">
            <i class="fa-solid fa-check btn-icon"></i>
            <span class="btn-label">{{ label }}</span>
        </button>
    </div>
</template>