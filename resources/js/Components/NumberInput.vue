<script setup>
defineProps({
    id: String,
    min: String,
    max: String,
    label: String,
    error: String,
    modelValue: Number,
});
defineEmits(['update:modelValue']);
</script>
<template>
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <input type="number" class="form-input" :class="{ error: error }" :value="modelValue" :id="id" :min="min" :max="max"
        @input="$emit('update:modelValue', $event.target.value)">
    <div v-if="error" class="form-error">{{ error }}</div>
</template>
<style scoped>
.form-input {
    width: 100%;
    border-radius: 6px;
    box-sizing: border-box;
    border: 1px solid rgb(226, 232, 240);
}

.form-input.error {
    border-color: rgb(185, 28, 28);

}
</style>