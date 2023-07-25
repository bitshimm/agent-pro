<template>
    <div class="form-group-item file-input">
        <span class="form-label">{{ label }}:</span>
        <label class="form-input">
            <input type="file" class="form-input" :class="{ error: error }" :id="id"
                @input="$emit('update:modelValue', $event.target.files[0])">
            <span class="form-input-label">Выберите файл</span>

            <span v-if="modelValue" class="form-input-name">&nbsp;{{ modelValue.name }}</span>
        </label>
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>
<script setup>
defineProps({
    id: String,
    label: String,
    error: String,
    modelValue: File,
});
defineEmits(['update:modelValue']);
</script>