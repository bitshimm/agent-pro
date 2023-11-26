<script setup>
import FormEl from '@/Components/FormEl.vue';
import { useForm, usePage } from '@inertiajs/vue3';

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
	<section class="section">
		<form class="form" @submit.prevent="submit">
			<div class="form-header">
				Тема
			</div>
			<div v-if="!themes.length">
				Нет доступных тем.
			</div>
			<div v-else class="form-items">
				<FormEl default-col="2">
					<label for="themes" class="form-label">Выберите тему:</label>
					<select v-model="form.theme_id">
						<option v-for="theme, idx in themes" :value="theme.id">{{
							theme.name }}</option>
					</select>
					<div v-if="form.errors.themes" class="form-error">{{ form.errors.theme_id }}</div>
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