<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3';

import Panel from '@/Components/Panel.vue';
import Number from '@/Components/Number.vue';
import Text from '@/Components/Text.vue';
import Wysiwig from '@/Components/Wysiwig.vue';
import BooleanField from '@/Components/Boolean.vue';
import Image from '@/Components/Image.vue';
import Submit from '@/Components/Submit.vue';

const props = defineProps({
	article: Object,
});

const form = useForm({
	title: props.article.title,
	content: props.article.content,
	sort: props.article.sort,
	active: Boolean(props.article.active),
	current_image: props.article.image,
	image: null,
	_method: 'patch',
});

const submit = () => {
	form.post(route('articles.update', props.article.id), {
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
				{{ form.title }}
			</h1>
		</template>
		<form @submit.prevent="submit">
			<Panel>
				<Text label="Заголовок" id="title" v-model="form.title" :error="form.errors.title" />
				<Image label="Изображение" id="image" v-model="form.image" :currentImage="form.current_image" :error="form.errors.image" />
				<Wysiwig label="Контент" id="content" v-model="form.content" :error="form.errors.content" />
				<Number label="Сортировка" id="sort" v-model="form.sort" :error="form.errors.sort" min="0" />
				<BooleanField label="Активно" id="active" v-model="form.active" :error="form.errors.active" />
				<Submit label="Сохранить" :disabled="!form.isDirty" />
			</Panel>
		</form>
	</DashboardLayout>
</template>
