<script setup>
import { useForm, usePage, Link } from '@inertiajs/vue3';
import Panel from '@/Components/Panel.vue';
import Image from '@/Components/Image.vue';
import Submit from '@/Components/Submit.vue';

const user = usePage().props.user;

const form = useForm({
	current_logotype: user.logotype,
	logotype: null,
	_method: 'patch',
});

const submit = () => {
	form.post(route('users.logotype.update', user.id), {

	});
};

</script>
<template>
	<form @submit.prevent="submit">
		<Panel label="Логотип">
			<Image id="user_logotype" label="Логотип" v-model="form.logotype" :currentImage="form.current_logotype"
				:error="form.errors.logotype" />
			<Submit label="Обновить" :disabled="!form.isDirty" />
		</Panel>
	</form>
</template>