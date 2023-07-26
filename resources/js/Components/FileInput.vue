<script setup>
const props = defineProps({
    id: String,
    label: String,
    error: String,
    modelValue: File,
    currentImage: String,
});

defineEmits(['update:modelValue']);
</script>
<template>
    <div class="form-item file-input">
        <span class="form-label" v-if="label">{{ label }}: <a :href="currentImage" v-if="currentImage" class="underline" target="_blank">ссылка</a></span>
        <label class="form-input">
            <input type="file" class="form-input" :class="{ error: error }" :id="id"
                @input="$emit('update:modelValue', $event.target.files[0])">
            <span class="form-input-label">Выберите файл</span>

            <span v-if="modelValue" class="form-input-name">&nbsp;{{ modelValue.name }}</span>
        </label>
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>
