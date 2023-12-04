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
	special_offer: Object,
});

const form = useForm({
	title: props.special_offer.title,
	content: props.special_offer.content,
	sort: props.special_offer.sort,
	active: Boolean(props.special_offer.active),
	current_image: props.special_offer.image,
	image: null,
	_method: 'patch',
})

const submit = () => {
	form.post(route('special-offers.update', props.special_offer.id));
};
</script>
<template>
	<Head title="Спец. предложения" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				<Link :href="route('special-offers.index')">Спец. предложения</Link>
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
