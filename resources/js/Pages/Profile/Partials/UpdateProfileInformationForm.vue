<script setup>
import FormEl from '@/Components/FormEl.vue';
import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
	mustVerifyEmail: {
		type: Boolean,
	},
	status: {
		type: String,
	},
});

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
	<section class="section">
		<form class="form" @submit.prevent="submit">
			<div class="form-header">
				Информация профиля
			</div>
			<div class="form-items">
				<FormEl defaultCol="2">
					<ResourseTextInput label="Имя" id="profile_information_name" :error="form.errors.name"
						v-model="form.name" required autocomplete="name" />
				</FormEl>
				<FormEl defaultCol="2">
					<ResourseTextInput type="email" label="Email" id="profile_information_email" :error="form.errors.email"
						v-model="form.email" required autocomplete="username" />
				</FormEl>
			</div>
			<div class="form-bottom">
				<button type="submit" class="btn_indigo ml-auto">
					<i class="fa-solid fa-pen btn-icon"></i>
					<span class="btn-label">Обновить</span>
				</button>
			</div>
			<div v-if="mustVerifyEmail && user.email_verified_at === null">
				<p class="text-sm mt-2 text-gray-800">
					Ваш адрес электронной почты не подтвержден.
					<Link :href="route('verification.send')" method="post" as="button"
						class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
					Нажмите здесь, чтобы повторно отправить письмо с подтверждением.
					</Link>
				</p>
				<div v-show="status === 'verification-link-sent'" class="mt-2 font-medium text-sm text-green-600">
					На ваш адрес электронной почты была отправлена ​​новая ссылка для подтверждения.
				</div>
			</div>
		</form>
	</section>
</template>
