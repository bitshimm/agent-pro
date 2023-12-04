<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'

import Panel from '@/Components/Panel.vue';
import Text from '@/Components/Text.vue';
import Submit from '@/Components/Submit.vue';

const form = useForm({
	name: '',
	icon: '',
})

const submit = () => {
	form.post(route('social-networks.store'), {
	});
};
</script>
<template>
	<Head title="Новости" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				<Link :href="route('social-networks.index')">Социальные сети</Link>
				<span class="text-indigo-400 font-medium"> /</span>
				Создание
			</h1>
		</template>
		<form @submit.prevent="submit">
			<Panel>
				<Text label="Название" id="name" v-model="form.name" :error="form.errors.name" />
				<Text label="Иконка" id="icon" v-model="form.icon" :error="form.errors.icon" />
				<div class="py-3">
					<div>
						Иконка: <span v-html="form.icon"></span>
					</div>
				</div>
				<Submit label="Добавить" :disabled="!form.isDirty" />
			</Panel>
		</form>
	</DashboardLayout>
</template>
