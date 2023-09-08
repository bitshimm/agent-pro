<script setup>
import FormEl from '@/Components/FormEl.vue';
import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.user;

const form = useForm({
	meta_title: user.meta_title,
	meta_description: user.meta_description,
});

const submit = () => {
	form.patch(route('users.meta.update', user.id), {

	});
};

</script>
<template>
	<section class="section">
		<form class="form" @submit.prevent="submit">
			<div class="form-header">
				Meta информация
			</div>
			<div class="form-items">
				<FormEl default-col="2">
					<ResourseTextInput label="Заголовок сайта" :error="form.errors.meta_title" v-model="form.meta_title" />
				</FormEl>
				<FormEl default-col="2">
					<label for="meta_description" class="form-label">Описание сайта:</label>
					<textarea class="w-full block"
						style="height: 200px; border-radius: 6px;border: 1px solid rgb(226, 232, 240);"
						v-model="form.meta_description" id="meta_description"></textarea>
					<div v-if="form.errors.meta_description" class="form-error">{{
						form.errors.meta_description }}</div>
				</FormEl>
			</div>
			<div class="form-bottom">
				<button type="submit" class="btn_indigo ml-auto">
					<i class="fa-solid fa-pen btn-icon"></i>
					<span class="btn-label">Обновить</span>
				</button>
			</div>
		</form>
	</section>
</template>