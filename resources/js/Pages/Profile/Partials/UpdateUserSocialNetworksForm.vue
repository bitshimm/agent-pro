<script setup>
import FormEl from '@/Components/FormEl.vue';
import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { onBeforeMount } from 'vue';

const social_networks = usePage().props.social_networks;
const user = usePage().props.auth.user;

const form = useForm({
	user_social_networks: [],
});

onBeforeMount(() => {
	user.social_networks.map((el) => {
		form.user_social_networks[el.pivot.social_network_id] = el.pivot.link
	})
});

const submit = () => {
	form.patch(route('profile.social-networks.update'), {

	});
};
</script>
<template>
	<section class="section">
		<form class="form" @submit.prevent="submit">
			<div class="form-header">
				Социальные сети
			</div>
			<div class="form-items">
				<FormEl v-for="social_network in social_networks">
					<ResourseTextInput :label="social_network.name" :id="'social_network_' + social_network.id"
						v-model="form.user_social_networks[social_network.id]" />
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