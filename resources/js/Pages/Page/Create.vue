<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'

import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import NumberInput from '@/Components/NumberInput.vue';
import WysiwigTextarea from "@/Components/WysiwigTextarea.vue";
import Checkbox from "@/Components/Checkbox.vue";
import FormEl from '@/Components/FormEl.vue';

const form = useForm({
	title: '',
	content: '',
	sort: 100,
	active: true
})

const submit = () => {
	form.post(route('pages.store'), {

	});
};
</script>
<template>
	<Head title="Страницы" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				<Link :href="route('articles.index')">Страницы</Link>
				<span class="text-indigo-400 font-medium"> /</span>
				Создание
			</h1>
		</template>
		<section class="section">
			<form @submit.prevent="submit" class="form">
				<div class="form-items">
					<FormEl>
						<ResourseTextInput label="Заголовок" id="title" :error="form.errors.title" v-model="form.title"
							autofocus />
					</FormEl>
					<FormEl>
						<WysiwigTextarea label="Контент" id="content" :error="form.errors.content" v-model="form.content" />
					</FormEl>
					<FormEl>
						<NumberInput label="Сортировка" id="sort" :error="form.errors.sort" v-model="form.sort" min="0" />
					</FormEl>
					<FormEl>
						<Checkbox label="Активно" id="active" :error="form.errors.active"
							v-model:checked="form.active" />
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
	</DashboardLayout>
</template>
