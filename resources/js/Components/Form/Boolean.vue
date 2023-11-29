<script setup>
import { computed } from 'vue';

const props = defineProps({
    modelValue: Boolean,
    value: {
        default: null,
    },
    id: String,
    label: String,
    error: String,
});

const emit = defineEmits(["update:modelValue"]);

const model = computed({
  get() {
    return props.modelValue;
  },
  set(value) {
    emit("update:modelValue", value);
  },
});
</script>

<template>
    <div class="flex flex-wrap py-4">
        <div class="w-full md:w-1/5 px-1">
            <label v-if="label" :for="id" class="pt-2">{{ label }}:</label>
        </div>
        <div class="w-full md:w-4/5 px-1">
            <input class="border rounded-md border-slate-200 w-6 h-6" :class="{ 'border-red-600': error }" type="checkbox"
                :value="value" :id="id" v-model="model" />
            <div v-if="error" class="text-red-600">{{ error }}</div>
        </div>
    </div>
</template>