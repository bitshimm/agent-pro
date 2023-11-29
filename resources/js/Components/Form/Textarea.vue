<script setup>
defineProps({
    id: {
        type: String,
    },
    label: {
        type: String,
    },
    error: {
        type: String,
    },
    modelValue: {
        type: String,
        required: true,
    },
});

defineEmits(['update:modelValue']);
</script>
<template>
    <div class="flex flex-wrap py-4">
        <div class="w-full md:w-1/5 px-1">
            <label v-if="label" :for="id" class="pt-2">{{ label }}:</label>
        </div>
        <div class="w-full md:w-4/5 px-1">
            <textarea class="border rounded-md border-slate-200 w-full" :class="{ 'border-red-600': error }" :id="id"
                cols="30" rows="10" @input="$emit('update:modelValue', $event.target.value)">{{ modelValue }}</textarea>
            <div v-if="error" class="text-red-600">{{ error }}</div>
        </div>
    </div>
</template>