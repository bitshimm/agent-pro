<script setup>
defineProps({
    id: String,
    label: String,
    error: String,
    options: Array,
    modelValue: Number|String,
});
defineEmits(['update:modelValue']);
</script>
<template>
    <div class="flex flex-wrap py-4">
        <div class="w-full lg:w-1/5 pr-4">
            <label v-if="label" :for="id" class="pt-2 cursor-pointer">{{ label }}:</label>
        </div>
        <div class="w-full lg:w-4/5 lg:max-w-md">
            <select class="border rounded-md w-full" :class="[error ? 'border-red-600' : 'border-slate-200']" :value="modelValue" :id="id" @change="$emit('update:modelValue', $event.target.value)">
                <option v-for="option, idx in options" :value="option.id">{{
                    option.name }}</option>
            </select>
            <div v-if="error" class="text-red-600">{{ error }}</div>
        </div>
    </div>
</template>