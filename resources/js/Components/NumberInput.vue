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
    <div class="form-item number-input">
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <input type="number" class="form-input" :class="{ error: error }" :value="modelValue" :id="id" :min="min" :max="max"
            @input="$emit('update:modelValue', $event.target.value)">
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>