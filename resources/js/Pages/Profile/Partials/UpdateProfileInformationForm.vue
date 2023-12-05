<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import Panel from '@/Components/Panel.vue';
import Text from '@/Components/Text.vue';
import Submit from '@/Components/Submit.vue';

const user = usePage().props.auth.user;

const form = useForm({
	name: user.name,
	email: user.email,
});

const submit = () => {
	form.patch(route('profile.update'), {
	});
};
</script>
<template>
	<form @submit.prevent="submit">
		<Panel label="Информация профиля">
			<Text id="user_information_name" label="Имя" v-model="form.name" :error="form.errors.name" />
			<Text type="email" id="user_information_email" label="Email" v-model="form.email" :error="form.errors.email" />
			<Submit label="Обновить" :disabled="!form.isDirty" />
		</Panel>
	</form>
</template>
