<script setup>
const props = defineProps({
	id: String,
	label: String,
	error: String,
	modelValue: File,
	currentImage: String,
});

defineEmits(['update:modelValue']);
</script>
<template>
	<div class="flex flex-wrap py-4">
		<div class="w-full lg:w-1/5 pr-4">
			<label v-if="label" :for="id" class="pt-2 cursor-pointer">{{ label }}:</label>
		</div>
		<div class="w-full lg:w-4/5 lg:max-w-screen-md">
			<div v-if="modelValue" class="truncate max-w-xs mb-2">
				{{ modelValue.name }}
			</div>
			<div v-else-if="currentImage">
				<a class="block border border-slate-200 bg-slate-200 mb-2" style="max-width: 200px;" :href="currentImage"
					target="_blank">
					<img :src="currentImage" alt="" class="w-full object-scale-down aspect-square">
				</a>
				<div class="text-xs truncate max-w-xs mb-2">
					{{ currentImage }}
				</div>
			</div>
			<label :for="id"
				class="w-full flex flex-wrap items-center cursor-pointer px-2 rounded-md border-4 border-dashed hover:border-gray-300"
				:class="[error ? 'border-red-600' : 'border-slate-200']">
				<input type="file" class="hidden" :id="id" @input="$emit('update:modelValue', $event.target.files[0])">
				<div class="my-2 px-3 py-2 bg-slate-200 rounded-md text-center">
					Выбрать Файл
				</div>
				<div class="my-2 px-4 text-center">Нажмите, чтобы выбрать файл</div>
			</label>
			<div v-if="error" class="text-red-600">{{ error }}</div>
		</div>
	</div>
</template>
