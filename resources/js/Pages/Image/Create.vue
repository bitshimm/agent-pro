<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'

import Panel from '@/Components/Panel.vue';
import Number from '@/Components/Number.vue';
import Text from '@/Components/Text.vue';
import BooleanField from '@/Components/Boolean.vue';
import Image from '@/Components/Image.vue';
import Submit from '@/Components/Submit.vue';

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
	<Head title="Галерея" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				<Link :href="route('images.index')">Галерея</Link>
				<span class="text-indigo-400 font-medium"> /</span>
				Создание
			</h1>
		</template>
		<form @submit.prevent="submit">
			<Panel>
				<Image label="Изображение" id="image" v-model="form.image" :error="form.errors.image" />
				<Text label="Alt" id="alt" v-model="form.alt" :error="form.errors.alt" />
				<Text label="Подпись" id="caption" v-model="form.caption" :error="form.errors.caption" />
				<Number label="Сортировка" id="sort" v-model="form.sort" :error="form.errors.sort" min="0" />
				<BooleanField label="Активно" id="active" v-model="form.active" :error="form.errors.active" />
				<Submit label="Добавить" :disabled="!form.isDirty" />
			</Panel>
		</form>
	</DashboardLayout>
</template>
