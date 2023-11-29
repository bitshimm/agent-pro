<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3';

import Panel from '@/Components/Form/Panel.vue';
import Number from '@/Components/Form/Number.vue';
import Text from '@/Components/Form/Text.vue';
import Wysiwig from '@/Components/Form/Wysiwig.vue';
import BooleanField from '@/Components/Form/Boolean.vue';
import Submit from '@/Components/Form/Submit.vue';
import FormEl from '@/Components/FormEl.vue';
import FileInput from '@/Components/FileInput.vue';

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
		<Panel>
			<form @submit.prevent="submit">
				<Text label="Заголовок" id="title" v-model="form.title" :error="form.errors.title" />
				<FormEl>
					<FileInput :label="form.current_image ? 'Заменить изображение' : 'Изображение'" id="image"
						:error="form.errors.image" v-model="form.image" :currentImage="form.current_image" />
				</FormEl>
				<Wysiwig label="Контент" id="content" v-model="form.content" :error="form.errors.content" />
				<Number label="Сортировка" id="sort" v-model="form.sort" :error="form.errors.sort" />
				<BooleanField label="Активно" id="active" v-model="form.active" :error="form.errors.active" />
				<Submit label="Сохранить" :disabled="!form.isDirty" />
			</form>
		</Panel>
	</DashboardLayout>
</template>
