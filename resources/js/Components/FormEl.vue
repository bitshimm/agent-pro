<script setup>
const props = defineProps({
    defaultCol: {
        default: 1
    }
});
</script>
<template>
    <div class="form-el" :class="'col' + props.defaultCol">
        <slot />
    </div>
</template>
<style>
.form-el {
    padding-bottom: 2rem;
    padding-right: 1.5rem;
}

.form-el.col2 {
    grid-column: 1 /-1;
}
</style>