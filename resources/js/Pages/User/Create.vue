<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'
import Panel from '@/Components/Panel.vue';
import Text from '@/Components/Text.vue';
import Image from '@/Components/Image.vue';
import Submit from '@/Components/Submit.vue';

const form = useForm({
	subdomain: '',
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
		<form @submit.prevent="submit">
			<Panel>
				<Text id="subdomain" label="Поддомен" v-model="form.subdomain" :error="form.errors.subdomain" />
				<Text id="name" label="Имя" v-model="form.name" :error="form.errors.name" />
				<Image label="Логотип" id="logotype" v-model="form.logotype" :error="form.errors.logotype" />
				<Text type="email" id="email" label="Email" v-model="form.email"
					:error="form.errors.email" />
				<Text type="password" id="password" label="Пароль" v-model="form.password"
					:error="form.errors.password" />
				<Text type="password" id="password_confirmation" label="Подтвердите пароль" v-model="form.password_confirmation"
					:error="form.errors.password_confirmation" />
				<Submit label="Добавить" :disabled="!form.isDirty" />
			</Panel>
		</form>
	</DashboardLayout>
</template>
