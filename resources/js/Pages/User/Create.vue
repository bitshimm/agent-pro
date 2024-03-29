<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'
import Panel from '@/Components/Panel.vue';
import Text from '@/Components/Text.vue';
import Image from '@/Components/Image.vue';
import Submit from '@/Components/Submit.vue';
import BooleanField from '@/Components/Boolean.vue';
import { ref } from 'vue';
import axios from 'axios';

const form = useForm({
	subdomain: '',
	name: '',
	logotype: null,
	email: '',
	password: '',
	password_confirmation: '',
	transfer_data: false,
});

const websiteExists = ref(false);
const checking = ref(false);
const lastSubdomainChecked = ref('');

const submit = () => {
	if (!form.subdomain || form.subdomain != lastSubdomainChecked.value || !websiteExists.value || checking.value) {
		form.transfer_data = false;
	}
	form.post(route('users.store'), {
	});
};

const websiteAvailability = () => {
	checking.value = true;
	axios.get(route('user.websiteAvailability', form.subdomain))
		.then(response => response.data)
		.then(data => {
			if (data.status == 'success') {
				websiteExists.value = true;
			} else {
				websiteExists.value = false;
			}
			checking.value = false;
			lastSubdomainChecked.value = form.subdomain;
		});
}
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
				<Text id="subdomain" label="Поддомен" v-model="form.subdomain" :error="form.errors.subdomain"
					:disabled="checking">
					<div v-if="checking" class="flex justify-center mt-2">
						<div class="border-gray-300 h-5 w-5 animate-spin rounded-full border-4 border-t-blue-600"></div>
						<div class="ml-2">Loading</div>
					</div>
					<div v-else-if="form.subdomain && form.subdomain != lastSubdomainChecked"
						class="bg-red-200 text-white text-center px-4 py-2 rounded cursor-pointer mt-2"
						@click="websiteAvailability">
						Проверить наличие
					</div>
					<div v-else-if="form.subdomain && form.subdomain == lastSubdomainChecked && websiteExists"
						class="text-center px-4 py-2 rounded mt-2" style="background-color: #ECF0D7; color: #A60B38;">
						Сайт найден!
						<div>
							<BooleanField label="Перенести данные" id="transfer_data" v-model="form.transfer_data" />
						</div>
					</div>
					<div v-else-if="form.subdomain && form.subdomain == lastSubdomainChecked && !websiteExists"
						class="bg-neutral-300 text-white text-center px-4 py-2 rounded mt-2">
						Сайт не найден!
					</div>
				</Text>
				<Text id="name" label="Имя" v-model="form.name" :error="form.errors.name" />
				<Image label="Логотип" id="logotype" v-model="form.logotype" :error="form.errors.logotype" />
				<Text type="email" id="email" label="Email" v-model="form.email" :error="form.errors.email" />
				<Text type="password" id="password" label="Пароль" v-model="form.password" :error="form.errors.password" />
				<Text type="password" id="password_confirmation" label="Подтвердите пароль"
					v-model="form.password_confirmation" :error="form.errors.password_confirmation" />
				<Submit label="Добавить" :disabled="!form.isDirty || checking" />
			</Panel>
		</form>
	</DashboardLayout>
</template>
