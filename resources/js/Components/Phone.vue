<script setup>
import { mask as vMask } from 'vue-the-mask';
defineProps({
    id: String,
    label: String,
    error: String,
    modelValue: String,
});
defineEmits(['update:modelValue']);
</script>
<template>
    <div class="flex flex-wrap py-4">
        <div class="w-full lg:w-1/5 pr-4">
            <label v-if="label" :for="id" class="pt-2 cursor-pointer">{{ label }}:</label>
        </div>
        <div class="w-full lg:w-4/5 lg:max-w-md">
            <input class="border rounded-md w-full max-w-screen-md" v-mask="'+7(###)###-##-##'"
                placeholder="+7(987)654-32-10" :class="[error ? 'border-red-600' : 'border-slate-200']" type="tel"
                :value="modelValue" :id="id" @input="$emit('update:modelValue', $event.target.value)">
            <div v-if="error" class="text-red-600">{{ error }}</div>
        </div>
    </div>
</template>