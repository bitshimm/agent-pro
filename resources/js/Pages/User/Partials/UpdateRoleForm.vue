<script setup>
import FormEl from '@/Components/FormEl.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';

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
	<section class="section">
		<form class="form" @submit.prevent="submit">
			<div class="form-header">
				Роль
			</div>
			<div class="form-items">
				<FormEl default-col="2">
					<label for="roles" class="form-label">Выберите роль:</label>
					<select v-model="form.role_id">
						<option v-for="role, idx in roles" :value="role.id">{{
							role.name }}</option>
					</select>
					<div v-if="form.errors.roles" class="form-error">{{ form.errors.role_id }}</div>
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