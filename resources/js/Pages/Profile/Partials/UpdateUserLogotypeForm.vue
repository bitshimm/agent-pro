<script setup>
import FileInput from '@/Components/FileInput.vue';
import FormEl from '@/Components/FormEl.vue';
import { useForm, usePage, Link } from '@inertiajs/vue3';

const user = usePage().props.user;

const form = useForm({
	current_logotype: user.logotype,
	logotype: null,
	_method: 'patch',
});

const submit = () => {
	form.post(route('profile.logotype.update'), {

	});
};

</script>
<template>
	<section class="section">
		<form class="form" @submit.prevent="submit">
			<div class="form-header">
				Логотип
			</div>
			<div class="form-items">
				<FormEl default-col="2">
					<FileInput :label="form.current_logotype ? 'Заменить' : 'Добавить'" id="logotype"
						:error="form.errors.logotype" v-model="form.logotype" :current-image="form.current_logotype" />
					<!-- <Link class="btn_danger" :href="route('publish')" method="delete" as="button">
					<i class="fa-solid fa-trash btn-icon"></i>
					<span class="btn-label">Удалить изображение</span>
					</Link> -->
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