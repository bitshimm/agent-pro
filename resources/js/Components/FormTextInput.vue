<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    id: String,
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
    <input class="form-input" :class="{ error: error }" :id="id" :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)" ref="input" v-bind="$attrs">
    <div v-if="error" class="form-error">{{ error }}</div>
</template>
<style>
.form-input {
    width: 100%;
    box-sizing: border-box;
}
</style>