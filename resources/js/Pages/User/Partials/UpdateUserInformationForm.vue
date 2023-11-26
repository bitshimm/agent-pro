<script setup>
import FormEl from '@/Components/FormEl.vue';
import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const form = useForm({
	name: user.name,
	email: user.email,
});
const submit = () => {
	form.patch(route('users.information.update', user.id), {

	});
};
</script>

<template>
	<section class="section">
		<form class="form" @submit.prevent="submit">
			<div class="form-header">
				Информация пользователя
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
				<button type="submit" class="btn_indigo ml-auto" :disabled="!form.isDirty">
					<i class="fa-solid fa-pen btn-icon"></i>
					<span class="btn-label">Обновить</span>
				</button>
			</div>
		</form>
	</section>
</template>
