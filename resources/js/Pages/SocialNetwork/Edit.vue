<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'

import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import FormEl from '@/Components/FormEl.vue';

const props = defineProps({
	social_network: Object,
});

const form = useForm({
	name: props.social_network.name,
	icon: props.social_network.icon,
})

const submit = () => {
	form.patch(route('social-networks.update', props.social_network.id), {
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
				{{ form.name }}
			</h1>
		</template>
		<section class="section">
			<form @submit.prevent="submit" class="form">
				<div class="form-items">
					<FormEl>
						<ResourseTextInput label="Название" id="name" :error="form.errors.name" v-model="form.name"
							autofocus required />
					</FormEl>
					<FormEl>
						<ResourseTextInput label="Иконка" id="icon" :error="form.errors.icon" v-model="form.icon"
							required />
					</FormEl>
				</div>
				<div class="py-3">
					<div>
						Иконка: <span v-html="form.icon"></span>
					</div>
				</div>
				<div class="form-bottom">
					<Link class="btn_danger" :href="route('social-networks.destroy', props.social_network.id)"
						method="delete" as="button">
					<i class="fa-solid fa-trash btn-icon"></i>
					<span class="btn-label">Удалить</span>
					</Link>
					<button type="submit" class="btn_indigo ml-auto" :disabled="!form.isDirty">
						<i class="fa-solid fa-check btn-icon"></i>
						<span class="btn-label">Сохранить</span>
					</button>
				</div>
			</form>
		</section>
	</DashboardLayout>
</template>
