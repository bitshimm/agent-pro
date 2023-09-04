<script setup>
import FormEl from '@/Components/FormEl.vue';
import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import WysiwigTextarea from '@/Components/WysiwigTextarea.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const props = usePage().props;

const form = useForm({
	about_title: props.about_title,
	about_short_description: props.about_short_description,
	about_full_description: props.about_full_description,
});

const submit = () => {
	form.patch(route('profile.about.update'), {

	});
};

</script>
<template>
	<section class="section">
		<form class="form" @submit.prevent="submit">
			<div class="form-header">
				О нас
			</div>
			<div class="form-items">
				<FormEl default-col="2">
					<ResourseTextInput label="Заголовок" :error="form.errors.about_title" v-model="form.about_title" />
				</FormEl>
				<FormEl default-col="2">
					<label for="about_short_description" class="form-label">Короткое описание:</label>
					<textarea class="w-full block"
						style="height: 200px; border-radius: 6px;border: 1px solid rgb(226, 232, 240);"
						v-model="form.about_short_description" id="about_short_description"></textarea>
					<div v-if="form.errors.about_short_description" class="form-error">{{
						form.errors.about_short_description }}</div>
				</FormEl>
				<FormEl default-col="2">
					<WysiwigTextarea label="Полное описание" id="about_full_description"
						:error="form.errors.about_full_description" :form="form" v-model="form.about_full_description" />
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