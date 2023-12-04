<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'

import Panel from '@/Components/Panel.vue';
import Number from '@/Components/Number.vue';
import Text from '@/Components/Text.vue';
import Wysiwig from '@/Components/Wysiwig.vue';
import BooleanField from '@/Components/Boolean.vue';
import Image from '@/Components/Image.vue';
import Submit from '@/Components/Submit.vue';

const form = useForm({
	title: '',
	image: null,
	content: '',
	sort: 100,
	active: true
})

const submit = () => {
	form.post(route('articles.store'), {

	});
};
</script>
<template>
	<Head title="Новости" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				<Link :href="route('articles.index')">Новости</Link>
				<span class="text-indigo-400 font-medium"> /</span>
				Создание
			</h1>
		</template>
		<form @submit.prevent="submit">
			<Panel>
				<Text label="Заголовок" id="title" v-model="form.title" :error="form.errors.title" />
				<Image label="Изображение" id="image" v-model="form.image" :error="form.errors.image" />
				<Wysiwig label="Контент" id="content" v-model="form.content" :error="form.errors.content" />
				<Number label="Сортировка" id="sort" v-model="form.sort" :error="form.errors.sort" min="0" />
				<BooleanField label="Активно" id="active" v-model="form.active" :error="form.errors.active" />
				<Submit label="Добавить" :disabled="!form.isDirty" />
			</Panel>
		</form>
	</DashboardLayout>
</template>
