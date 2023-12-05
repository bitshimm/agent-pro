<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import Panel from '@/Components/Panel.vue';
import Select from '@/Components/Select.vue';
import Submit from '@/Components/Submit.vue';

const user = usePage().props.user;
const themes = usePage().props.themes;

const form = useForm({
	theme_id: user.theme_id,
});

const submit = () => {
	form.patch(route('profile.theme.update'), {

	});
};
</script>
<template>
	<form @submit.prevent="submit">
		<Panel label="Тема">
			<div v-if="!themes.length">
				Нет доступных тем.
			</div>
			<Select v-else label="Выбрать тему" id="user_theme" v-model="form.theme_id" :options="themes" :error="form.errors.themes" />
			<Submit label="Обновить" :disabled="!form.isDirty" />
		</Panel>
	</form>
</template>