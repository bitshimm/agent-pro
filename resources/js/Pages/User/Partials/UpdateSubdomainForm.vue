<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import Panel from '@/Components/Panel.vue';
import Text from '@/Components/Text.vue';
import Submit from '@/Components/Submit.vue';

const user = usePage().props.user;

const form = useForm({
	subdomain: user.subdomain
});

const submit = () => {
	form.patch(route('users.subdomain.update', user.id), {

	});
};
</script>
<template>
	<form @submit.prevent="submit">
		<Panel label="Поддомен">
			<Text id="user_subdomain" label="Введите поддомен"
				v-model="form.subdomain" :error="form.errors.subdomain" />
			<Submit label="Обновить" :disabled="!form.isDirty" />
		</Panel>
	</form>
</template>