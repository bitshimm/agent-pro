<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'

import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import NumberInput from '@/Components/NumberInput.vue';
import Checkbox from "@/Components/Checkbox.vue";
import FormEl from '@/Components/FormEl.vue';

const form = useForm({
	image: null,
	alt: '',
	caption: '',
	sort: 100,
	active: true,
});

const submit = () => {
	form.post(route('images.store'), {

	});
};
</script>
<template>
	<Head title="Изображения" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				<Link :href="route('images.index')">Изображения</Link>
				<span class="text-indigo-400 font-medium"> /</span>
				Создание
			</h1>
		</template>
		<section class="section">
			<form @submit.prevent="submit" class="form">
				<div class="form-items">
					<FormEl>
						<FileInput label="Изображение" id="image" :error="form.errors.image" v-model="form.image" />
					</FormEl>
					<FormEl>
						<ResourseTextInput label="Alt" id="alt" :error="form.errors.alt" v-model="form.alt" />
					</FormEl>
					<FormEl>
						<ResourseTextInput label="Подпись" id="caption" :error="form.errors.caption"
							v-model="form.caption" />
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
