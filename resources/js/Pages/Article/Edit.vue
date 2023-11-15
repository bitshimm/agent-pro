<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3';

import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import NumberInput from '@/Components/NumberInput.vue';
import WysiwigTextarea from "@/Components/WysiwigTextarea.vue";
import Checkbox from "@/Components/Checkbox.vue";
import FormEl from '@/Components/FormEl.vue';

const props = defineProps({
	article: Object,
});

const form = useForm({
	title: props.article.title,
	content: props.article.content,
	sort: props.article.sort,
	visibility: Boolean(props.article.visibility),
	current_image: props.article.image,
	image: null,
	_method: 'patch',
})

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
		<section class="section">
			<form @submit.prevent="submit" class="form">
				<div class="form-items">
					<FormEl>
						<ResourseTextInput label="Заголовок" id="title" :error="form.errors.title" v-model="form.title" />
					</FormEl>
					<FormEl>
						<FileInput :label="form.current_image ? 'Заменить изображение' : 'Изображение'" id="image"
							:error="form.errors.image" v-model="form.image" :currentImage="form.current_image" />
					</FormEl>
					<FormEl>
						<WysiwigTextarea label="Контент" id="content" :error="form.errors.content" v-model="form.content" />
					</FormEl>
					<FormEl>
						<NumberInput label="Сортировка" id="sort" :error="form.errors.sort" v-model="form.sort" min="0" />
					</FormEl>
					<FormEl>
						<Checkbox label="Активно" id="visibility" :error="form.errors.visibility"
							v-model:checked="form.visibility" />
					</FormEl>
				</div>
				<div class="form-bottom">
					<Link class="btn_danger" :href="route('articles.destroy', props.article.id)" method="delete"
						as="button">
					<i class="fa-solid fa-trash btn-icon"></i>
					<span class="btn-label">Удалить</span>
					</Link>
					<button type="submit" class="btn_indigo ml-auto">
						<i class="fa-solid fa-check btn-icon"></i>
						<span class="btn-label">Сохранить</span>
					</button>
				</div>
			</form>
		</section>
	</DashboardLayout>
</template>
