<script setup>
import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import PhoneInput from "@/Components/PhoneInput.vue";
import { useForm, usePage } from '@inertiajs/vue3';
import FormEl from '@/Components/FormEl.vue';

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
	<section class="section">
		<form class="form" @submit.prevent="submit">
			<div class="form-header">
				Контакты
			</div>
			<div class="form-items">
				<FormEl>
					<PhoneInput id="contact_phone" label="Контактый телефон" :error="form.errors.contact_phone"
						v-model="form.contact_phone" />
				</FormEl>
				<FormEl>
					<PhoneInput id="contact_phone_second" label="Контактый телефон (дополнительный)"
						:error="form.errors.contact_phone_second" v-model="form.contact_phone_second" />
				</FormEl>
				<FormEl>
					<ResourseTextInput id="contact_email" label="Контактый email" :error="form.errors.contact_email"
						v-model="form.contact_email" type="email" />
				</FormEl>
				<FormEl>
					<ResourseTextInput id="contact_address" label="Контактный адрес" :error="form.errors.contact_address"
						v-model="form.contact_address" />
				</FormEl>
				<FormEl>
					<ResourseTextInput id="contact_opening_hours" label="Часы работы"
						:error="form.errors.contact_opening_hours" v-model="form.contact_opening_hours" />
				</FormEl>
			</div>
			<div class="form-bottom">
				<button type="submit" class="btn_indigo ml-auto" :disabled="!form.isDirty">
					<i class="fa-solid fa-pen btn-icon"></i>
					<span class="btn-label">Обновить</span>
				</button>
			</div>
		</form>
	</section>
</template>