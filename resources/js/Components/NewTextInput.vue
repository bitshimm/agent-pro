<template>
    <div class="form-group-item text-input">
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <input type="text" class="form-input" :class="{ error: error }" :value="modelValue" :id="id"
            @input="$emit('update:modelValue', $event.target.value)">
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>
<script setup>
defineProps({
    id: String,
    label: String,
    error: String,
    modelValue: String,
});
defineEmits(['update:modelValue']);
</script>