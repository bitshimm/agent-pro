<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { onBeforeMount } from 'vue';
import Panel from '@/Components/Panel.vue';
import Text from '@/Components/Text.vue';
import Submit from '@/Components/Submit.vue';

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
	<form @submit.prevent="submit">
		<Panel label="Социальные сети">
			<template v-for="social_network in social_networks">
				<Text :id="'profile_social_network_' + social_network.id" :label="social_network.name"
					v-model="form.user_social_networks[social_network.id]" />
			</template>
			<Submit label="Обновить" :disabled="!form.isDirty" />
		</Panel>
	</form>
</template>