<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { onBeforeMount } from 'vue';
import Panel from '@/Components/Panel.vue';
import Text from '@/Components/Text.vue';
import Submit from '@/Components/Submit.vue';

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
	<form @submit.prevent="submit">
		<Panel label="Социальные сети">
			<template v-for="social_network in social_networks">
				<Text type="url" :id="'user_social_network_' + social_network.id" :label="social_network.name"
					v-model="form.user_social_networks[social_network.id]" />
			</template>
			<Submit label="Обновить" :disabled="!form.isDirty" />
		</Panel>
	</form>
</template>