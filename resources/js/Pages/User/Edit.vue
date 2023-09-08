<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3';
import UpdateRoleForm from './Partials/UpdateRoleForm.vue';
import UpdateSubdomainForm from './Partials/UpdateSubdomainForm.vue';
import UpdateUserInformationForm from './Partials/UpdateUserInformationForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateLogotypeForm from './Partials/UpdateLogotypeForm.vue';
import UpdateContactsForm from './Partials/UpdateContactsForm.vue';
import UpdateSocialNetworksForm from './Partials/UpdateSocialNetworksForm.vue';
import UpdateWidgetForm from './Partials/UpdateWidgetForm.vue';
import UpdateAboutForm from './Partials/UpdateAboutForm.vue';
import DeleteForm from './Partials/DeleteForm.vue';
import UpdateMetaForm from './Partials/UpdateMetaForm.vue';

const props = defineProps(['user']);
const isAdmin = usePage().props.auth.isAdmin;
const isManager = usePage().props.auth.isManager;

</script>
<template>
	<Head title="Пользователи" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				<Link :href="route('users.index')">Пользователи</Link>
				<span class="text-indigo-400 font-medium"> /</span>
				{{ props.user.name }}
			</h1>
		</template>

		<UpdateRoleForm v-if="isAdmin" />
		<UpdateSubdomainForm />
		<UpdateUserInformationForm />
		<UpdatePasswordForm />
		<UpdateLogotypeForm />
		<UpdateContactsForm />
		<UpdateSocialNetworksForm />
		<UpdateWidgetForm />
		<UpdateAboutForm />
		<UpdateMetaForm />
		<DeleteForm />
	</DashboardLayout>
</template>
