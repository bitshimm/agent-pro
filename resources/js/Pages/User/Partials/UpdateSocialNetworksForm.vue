<script setup>
import FormEl from '@/Components/FormEl.vue';
import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { onBeforeMount } from 'vue';

const props = usePage().props;
const user = props.user;
const social_networks = props.social_networks;
const user_social_networks = props.user_social_networks;

const form = useForm({
	user_social_networks: {}
});
onBeforeMount(() => {
	user_social_networks.map((user_social_network) => {
		form.user_social_networks[user_social_network.pivot.social_network_id] = user_social_network.pivot.link
	})
})
const submit = () => {
	form.patch(route('users.social-networks.update', user.id), {

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
				<button type="submit" class="btn_indigo ml-auto">
					<i class="fa-solid fa-pen btn-icon"></i>
					<span class="btn-label">Обновить</span>
				</button>
			</div>
		</form>
	</section>
</template>