<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Panel from '@/Components/Panel.vue';
import Image from '@/Components/Image.vue';
import Text from '@/Components/Text.vue';
import Color from '@/Components/Color.vue';
import Submit from '@/Components/Submit.vue';

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
		<form @submit.prevent="submit">
			<Panel>
				<Text label="Название" id="name" v-model="form.name" :error="form.errors.name" />
				<Image label="Фон" id="background" v-model="form.background" :error="form.errors.background" />
				<template v-for="property, key in form.properties">
					<Color :label="property.name" :id="key" v-model="property.value" :error="form.errors.properties" />
				</template>
				<Submit label="Добавить" :disabled="!form.isDirty" />
			</Panel>
		</form>
	</DashboardLayout></template>
