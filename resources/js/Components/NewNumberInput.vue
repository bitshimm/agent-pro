<template>
    <div class="form-group-item number-input">
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <input type="number" class="form-input" :class="{ error: error }" :value="modelValue" :id="id" :min="min" :max="max"
            @input="$emit('update:modelValue', $event.target.value)">
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>
<script setup>
defineProps({
    id: String,
    min: Number,
    max: Number,
    label: String,
    error: String,
    modelValue: String,
});
defineEmits(['update:modelValue']);
</script>