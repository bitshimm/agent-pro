<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import Panel from '@/Components/Panel.vue';
import Text from '@/Components/Text.vue';
import Textarea from '@/Components/Textarea.vue';
import Submit from '@/Components/Submit.vue';

const user = usePage().props.user;

const form = useForm({
	meta_title: user.meta_title,
	meta_description: user.meta_description,
});

const submit = () => {
	form.patch(route('users.meta.update', user.id), {
	});
};
</script>
<template>
	<form @submit.prevent="submit">
		<Panel label="Meta информация">
			<Text id="user_meta_title" label="Заголовок сайта" v-model="form.meta_title" :error="form.errors.meta_title" />
			<Textarea id="user_meta_description" label="Описание сайта" v-model="form.meta_description"
				:error="form.errors.meta_description" />
			<Submit label="Обновить" :disabled="!form.isDirty" />
		</Panel>
	</form>
</template>