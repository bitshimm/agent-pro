<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import Panel from '@/Components/Panel.vue';
import Text from '@/Components/Text.vue';
import Textarea from '@/Components/Textarea.vue';
import Wysiwig from '@/Components/Wysiwig.vue';
import Submit from '@/Components/Submit.vue';

const user = usePage().props.user;

const form = useForm({
	about_title: user.about_title,
	about_short_description: user.about_short_description,
	about_full_description: user.about_full_description,
});

const submit = () => {
	form.patch(route('profile.about.update'), {

	});
};
</script>
<template>
	<form @submit.prevent="submit">
		<Panel label="О нас">
			<Text label="Заголовок" id="about_title" v-model="form.about_title" :error="form.errors.about_title" />
			<Textarea label="Короткое описание" id="about_short_description" v-model="form.about_short_description" :error="form.errors.about_short_description" />
			<Wysiwig label="Полное описание" id="about_full_description" v-model="form.about_full_description" :error="form.errors.about_full_description" />
			<Submit label="Обновить" :disabled="!form.isDirty" />
		</Panel>
	</form>
</template>