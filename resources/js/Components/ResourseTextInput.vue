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
    <div class="form-item text-input">
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <input class="form-input" :class="{ error: error }" :value="modelValue" :id="id"
            @input="$emit('update:modelValue', $event.target.value)" ref="input" v-bind="$attrs">
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>