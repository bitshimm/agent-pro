<script setup>
const props = defineProps({
    for: {
        type: String,
    },
    value: {
        type: String,
        required: true,
    }
})
</script>
<template>
    <label :for="props.for">{{ props.value }}</label>
</template>
<style>
.form-label {
    display: block;
    margin-bottom: 8px;
}
</style>