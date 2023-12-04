<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import Panel from '@/Components/Panel.vue';
import Text from '@/Components/Text.vue';
import Phone from '@/Components/Phone.vue';
import Submit from '@/Components/Submit.vue';

const user = usePage().props.user;

const form = useForm({
	contact_phone: user.contact_phone,
	contact_phone_second: user.contact_phone_second,
	contact_email: user.contact_email,
	contact_address: user.contact_address,
	contact_opening_hours: user.contact_opening_hours,
});

const submit = () => {
	form.patch(route('profile.contacts.update'), {

	});
};
</script>
<template>
	<form @submit.prevent="submit">
		<Panel label="Контакты">
			<Phone id="profile_contact_phone" label="Контактый телефон" v-model="form.contact_phone" :error="form.errors.contact_phone"/>
			<Phone id="profile_contact_phone_second" label="Контактый телефон (дополнительный)" v-model="form.contact_phone_second" :error="form.errors.contact_phone_second"/>
			<Text id="profile_contact_email" label="Контактый email" v-model="form.contact_email" :error="form.errors.contact_email" type="email" />
			<Text id="profile_contact_address" label="Контактный адрес" v-model="form.contact_address" :error="form.errors.contact_address"/>
			<Text id="profile_contact_opening_hours" label="Часы работы" v-model="form.contact_opening_hours" :error="form.errors.contact_opening_hours"/>
			<Submit label="Обновить" :disabled="!form.isDirty" />
		</Panel>
	</form>
</template>