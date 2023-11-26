<script setup>
import FormEl from '@/Components/FormEl.vue';
import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';

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
	<section class="section">
		<form class="form" @submit.prevent="submit">
			<div class="form-header">
				Поддомен
			</div>
			<div class="form-items">
				<FormEl default-col="2">
					<ResourseTextInput id="subdomain" label="Введите поддомен" :error="form.errors.subdomain"
						v-model="form.subdomain" />
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