<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    id: String,
    label: String,
    error: String,
    modelValue: {
        type: String,
        required: true,
    },
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>
<script>
export default {
    inheritAttrs: false,
}
</script>
<template>
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <input class="form-input" :class="{ error: error }" :id="id" :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)" ref="input" v-bind="$attrs">
    <div v-if="error" class="form-error">{{ error }}</div>
</template>
<style scoped>

.form-input{
    width: 100%;
    border-radius: 6px;
    box-sizing: border-box;
    border: 1px solid rgb(226, 232, 240);
}
.form-input.error {
    border-color: rgb(185, 28, 28);
}
.form-input[type="color"] {
	padding: 0;
	height: 40px;
}
</style>