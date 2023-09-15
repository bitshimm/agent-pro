<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'

import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import FormEl from '@/Components/FormEl.vue';
import { onMounted } from 'vue';

const props = defineProps(['theme']);

const form = useForm({
	name: props.theme.name,
	current_background: props.theme.background,
	background: null,
	properties: props.theme.properties,
	_method: 'patch',
});

const submit = () => {
	form.post(route('themes.update', props.theme.id), {

	});
};
</script>
<template>
	<Head title="Темы" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				<Link :href="route('articles.index')">Темы</Link>
				<span class="text-indigo-400 font-medium"> /</span>
				{{ form.name }}
			</h1>
		</template>
		<section class="section">
			<form @submit.prevent="submit" class="form">
				<div class="form-items">
					<FormEl default-col="2">
						<ResourseTextInput label="Название" :id="name" :error="form.errors.name" v-model="form.name" required />
					</FormEl>
					<FormEl default-col="2">
						<FileInput label="Фон" id="image" :error="form.errors.background" v-model="form.background" :currentImage="form.current_background" />
					</FormEl>
					<FormEl v-for="property, key in form.properties">
						<ResourseTextInput type="color" :label="property.name" :id="key" :error="form.errors.properties" v-model="property.value" />
					</FormEl>
				</div>
				<div class="form-bottom">
					<!-- <Link class="btn_danger" :href="route('themes.destroy', props.theme.id)" method="delete" as="button">
					<i class="fa-solid fa-trash btn-icon"></i>
					<span class="btn-label">Удалить</span>
					</Link> -->
					<button type="submit" class="btn_indigo ml-auto">
						<i class="fa-solid fa-plus btn-icon"></i>
						<span class="btn-label">Сохранить</span>
					</button>
				</div>
			</form>
		</section>
	</DashboardLayout>
</template>
