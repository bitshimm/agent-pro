<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'

import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import FormEl from '@/Components/FormEl.vue';
import { onMounted } from 'vue';

const props = defineProps({
	defaultThemes: Array,
	properties: Array,
});

const form = useForm({
	name: '',
	background: null,
	properties: props.properties,
});

const submit = () => {
	form.post(route('themes.store'), {

	});
};
</script>
<template>
	<Head title="Темы" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				<Link :href="route('themes.index')">Темы</Link>
				<span class="text-indigo-400 font-medium"> /</span>
				Создание
			</h1>
		</template>
		<section class="section">
			<form @submit.prevent="submit" class="form">
				<div class="form-items">
					<FormEl default-col="2">
						<ResourseTextInput label="Название" :id="name" :error="form.errors.name" v-model="form.name"
							required />
					</FormEl>
					<FormEl default-col="2">
						<FileInput label="Фон" id="image" :error="form.errors.background" v-model="form.background"
							required />
					</FormEl>
					<FormEl v-for="property, key in form.properties">
						<ResourseTextInput type="color" :label="property.name" :id="key" :error="form.errors.properties"
							v-model="property.value" />
					</FormEl>
				</div>
				<div class="form-bottom">
					<button type="submit" class="btn_indigo ml-auto">
						<i class="fa-solid fa-plus btn-icon"></i>
						<span class="btn-label">Добавить</span>
					</button>
				</div>
			</form>
		</section>
	</DashboardLayout></template>
