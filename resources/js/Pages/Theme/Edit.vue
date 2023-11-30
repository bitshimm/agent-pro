<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'

import Panel from '@/Components/Form/Panel.vue';
import Image from '@/Components/Form/Image.vue';
import Text from '@/Components/Form/Text.vue';
import Color from '@/Components/Form/Color.vue';
import Submit from '@/Components/Form/Submit.vue';


const props = defineProps({
	theme: Object,
});

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
		<form @submit.prevent="submit">
			<Panel>
				<Text label="Название" id="name" v-model="form.name" :error="form.errors.name" />
				<Image label="Фон" id="background" v-model="form.background" :error="form.errors.background"
					:currentImage="form.current_background" />
				<template v-for="property, key in form.properties">
					<Color :label="property.name" :id="key" v-model="property.value" :error="form.errors.properties" />
				</template>
				<Submit label="Сохранить" :disabled="!form.isDirty" />
			</Panel>
		</form>
	</DashboardLayout>
</template>
