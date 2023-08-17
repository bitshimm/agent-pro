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
    <span class="form-label" v-if="label">{{ label }}: <a :href="currentImage" v-if="currentImage" class="underline"
            target="_blank">ссылка</a></span>
    <label class="form-input">
        <input type="file" class="form-input" :class="{ error: error }" :id="id"
            @input="$emit('update:modelValue', $event.target.files[0])">
        <span class="form-input-caption">Выберите файл</span>

        <span v-if="modelValue" class="form-input-name">&nbsp;{{ modelValue.name }}</span>
    </label>
    <div v-if="error" class="form-error">{{ error }}</div>
</template>
<style scoped>
.form-input {
    width: 100%;
    cursor: pointer;
    border-radius: 6px;
    box-sizing: border-box;
    border: 1px solid rgb(226, 232, 240);
    display: flex;
    padding: 0;
}
.form-input.error {
    border-color: rgb(185, 28, 28);
}
.form-input input {
    display: none;
}

.form-input .form-input-caption {
    white-space: nowrap;
    background-color: rgb(226, 232, 240);
    padding: 0.5rem 0.75rem;
}
.form-input .form-input-name {
    padding: 0.5rem 0.75rem;
    max-width: 400px;
    width: 200px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
</style>
