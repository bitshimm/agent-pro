<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3';

import Panel from '@/Components/Form/Panel.vue';
import Number from '@/Components/Form/Number.vue';
import Text from '@/Components/Form/Text.vue';
import BooleanField from '@/Components/Form/Boolean.vue';
import Image from '@/Components/Form/Image.vue';
import Submit from '@/Components/Form/Submit.vue';

const props = defineProps({
	image: Object,
});

const form = useForm({
	path_full: props.image.path_full,
	path_thumb: props.image.path_thumb,
	image: null,
	alt: props.image.alt,
	caption: props.image.caption,
	sort: props.image.sort,
	active: Boolean(props.image.active),
	_method: 'patch',
});

const submit = () => {
	form.post(route('images.update', props.image.id), {
	});
};
</script>
<template>
	<Head title="Изображения" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				<Link :href="route('articles.index')">Изображения</Link>
				<span class="text-indigo-400 font-medium"> /</span>
				{{ form.caption }}
			</h1>
		</template>
		<form @submit.prevent="submit">
			<Panel>
				<Image label="Изображение" id="image" v-model="form.image" :error="form.errors.image" :currentImage="form.path_full" />
				<Text label="Alt" id="alt" v-model="form.alt" :error="form.errors.alt" />
				<Text label="Подпись" id="caption" v-model="form.caption" :error="form.errors.caption" />
				<Number label="Сортировка" id="sort" v-model="form.sort" :error="form.errors.sort" min="0" />
				<BooleanField label="Активно" id="active" v-model="form.active" :error="form.errors.active" />
				<Submit label="Сохранить" :disabled="!form.isDirty" />
			</Panel>
		</form>
	</DashboardLayout>
</template>
