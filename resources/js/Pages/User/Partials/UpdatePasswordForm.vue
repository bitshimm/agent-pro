<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import Panel from '@/Components/Panel.vue';
import Text from '@/Components/Text.vue';
import Submit from '@/Components/Submit.vue';

const user = usePage().props.user;
const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
	current_password: '',
	password: '',
	password_confirmation: '',
});

const updatePassword = () => {
	form.patch(route('users.password.update', user.id), {
		preserveScroll: true,
		onSuccess: () => form.reset(),
		onError: () => {
			if (form.errors.password) {
				form.reset('password', 'password_confirmation');
				passwordInput.value.focus();
			}
			if (form.errors.current_password) {
				form.reset('current_password');
				currentPasswordInput.value.focus();
			}
		},
	});
};
</script>
<template>
	<form @submit.prevent="updatePassword">
		<Panel label="Обновление пароля">
			<Text type="password" id="user_current_password" label="Текущий пароль" v-model="form.current_password" :error="form.errors.current_password" />
			<Text type="password" id="user_password" label="Новый пароль" v-model="form.password" :error="form.errors.password" />
			<Text type="password" id="user_password_confirmation" label="Новый пароль" v-model="form.password_confirmation" :error="form.errors.password_confirmation" />
			<Submit label="Обновить" :disabled="!form.isDirty" />
		</Panel>
	</form>
</template>
