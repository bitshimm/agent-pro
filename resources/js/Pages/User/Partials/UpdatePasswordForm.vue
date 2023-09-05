<script setup>
import FormEl from '@/Components/FormEl.vue';
import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

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
	<section class="section">
		<form class="form" @submit.prevent="updatePassword">
			<div class="form-header">
				Обновление пароля
			</div>
			<div class="form-items">
				<FormEl defaultCol="2">
					<ResourseTextInput type="password" label="Текущий пароль" id="current_password"
						:error="form.errors.current_password" v-model="form.current_password"
						autocomplete="current-password" />
				</FormEl>
				<FormEl defaultCol="2">
					<ResourseTextInput type="password" label="Новый пароль" id="password" :error="form.errors.password"
						v-model="form.password" required autocomplete="new-password" />
				</FormEl>
				<FormEl defaultCol="2">
					<ResourseTextInput type="password" label="Новый пароль" id="password_confirmation"
						:error="form.errors.password_confirmation" v-model="form.password_confirmation" required
						autocomplete="new-password" />
				</FormEl>
			</div>
			<div class="form-bottom">
				<button type="submit" class="btn_indigo ml-auto">
					<i class="fa-solid fa-pen btn-icon"></i>
					<span class="btn-label">Обновить</span>
				</button>
			</div>
		</form>
	</section>
</template>
