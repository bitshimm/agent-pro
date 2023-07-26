<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
    id: String,
    label: String,
    error: String,
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <div class="form-item checkbox-input">
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <input type="checkbox" class="form-input" :class="{ error: error }" :value="value" :id="id" v-model="proxyChecked"  />
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>
