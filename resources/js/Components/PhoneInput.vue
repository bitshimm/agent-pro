<script setup>
import {mask as vMask} from 'vue-the-mask';
defineProps({
    id: String,
    label: String,
    error: String,
    modelValue: String,
});
defineEmits(['update:modelValue']);
</script>
<template>
    <div class="form-item phone-input">
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <input type="tel" v-mask="'+7(###)###-##-##'" placeholder="+7(987)654-32-10" class="form-input" :class="{ error: error }" :value="modelValue" :id="id"
            @input="$emit('update:modelValue', $event.target.value)">
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>