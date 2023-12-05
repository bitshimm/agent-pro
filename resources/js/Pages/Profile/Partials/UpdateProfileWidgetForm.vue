<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import Panel from '@/Components/Panel.vue';
import Textarea from '@/Components/Textarea.vue';
import Submit from '@/Components/Submit.vue';

const user = usePage().props.user;

const form = useForm({
	widget: user.widget
});

const submit = () => {
	form.patch(route('profile.widget.update'), {
	});
};
</script>
<template>
	<form @submit.prevent="submit">
		<Panel label="Виджет">
			<Textarea id="profile_widget" label="Вставьте код" v-model="form.widget" :error="form.errors.widget" />
			<Submit label="Обновить" :disabled="!form.isDirty" />
		</Panel>
	</form>
</template>