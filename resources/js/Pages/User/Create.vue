<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'

import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import FormEl from '@/Components/FormEl.vue';
import FileInput from '@/Components/FileInput.vue';

const form = useForm({
	name: '',
	logotype: null,
	email: '',
	password: '',
	password_confirmation: '',
})

const submit = () => {
	form.post(route('users.store'), {

	});
};
</script>
<template>
	<Head title="Пользователи" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				<Link :href="route('users.index')">Пользователи</Link>
				<span class="text-indigo-400 font-medium"> /</span>
				Создание
			</h1>
		</template>
		<section class="section">
			<form @submit.prevent="submit" class="form">
				<div class="form-items">
					<FormEl>
						<ResourseTextInput label="Имя" id="name" :error="form.errors.name" v-model="form.name" autofocus />
					</FormEl>
					<FormEl>
						<FileInput label="Логотип" id="logotype"
							:error="form.errors.logotype" v-model="form.logotype" />
					</FormEl>
					<FormEl>
						<ResourseTextInput type="email" label="Email" id="email" :error="form.errors.email"
							v-model="form.email" />
					</FormEl>
					<FormEl>
						<ResourseTextInput type="password" label="Пароль" id="password" :error="form.errors.password"
							v-model="form.password" />
					</FormEl>
					<FormEl>
						<ResourseTextInput type="password" label="Подтвердите пароль" id="password_confirmation"
							:error="form.errors.password_confirmation" v-model="form.password_confirmation" />
					</FormEl>
				</div>
				<div class="form-bottom">
					<button type="submit" class="btn_indigo ml-auto">
						<i class="fa-solid fa-plus btn-icon"></i>
						<span class="btn-label">Добавить</span>
					</button>
				</div>
			</form>
		</section>
	</DashboardLayout>
</template>
