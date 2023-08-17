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
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <input type="checkbox" class="form-input" :class="{ error: error }" :value="value" :id="id" v-model="proxyChecked" />
    <div v-if="error" class="form-error">{{ error }}</div>
</template>
<style scoped>
.form-label {
    display: inline-block;
}
.form-input {
    display: inline-block;
    margin-left: 10px;
    width: 22px;
    height: 22px;
    border-radius: 6px;
}
</style>
