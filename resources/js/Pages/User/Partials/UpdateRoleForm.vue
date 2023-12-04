<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import Panel from '@/Components/Panel.vue';
import Select from '@/Components/Select.vue';
import Submit from '@/Components/Submit.vue';

const user = usePage().props.user;
const roles = usePage().props.roles;

const form = useForm({
	role_id: user.role_id,
});

const submit = () => {
	form.patch(route('users.role.update', user.id), {

	});
};
</script>

<template>
	<form @submit.prevent="submit">
		<Panel label="Роль">
			<Select label="Выбрать роль" id="user_role" v-model="form.role_id" :options="roles" :error="form.errors.role_id"  />
			<Submit label="Обновить" :disabled="!form.isDirty" />
		</Panel>
	</form>
</template>