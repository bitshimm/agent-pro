<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import UpdateProfileRoleForm from './Partials/UpdateProfileRoleForm.vue';
import UpdateProfileSubdomainForm from './Partials/UpdateProfileSubdomainForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileThemeForm from './Partials/UpdateProfileThemeForm.vue';
import UpdateProfileSocialNetworksForm from './Partials/UpdateProfileSocialNetworksForm.vue';
import UpdateProfileWidgetForm from './Partials/UpdateProfileWidgetForm.vue';
import UpdateProfileAboutForm from './Partials/UpdateProfileAboutForm.vue';
import UpdateProfileContacts from './Partials/UpdateProfileContactsForm.vue';
import UpdateProfileLogotypeForm from './Partials/UpdateProfileLogotypeForm.vue';
import UpdateProfileMetaForm from './Partials/UpdateProfileMetaForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineProps({
	mustVerifyEmail: Boolean,
	status: String
});
const isAdmin = usePage().props.auth.isAdmin;
const isManager = usePage().props.auth.isManager;

</script>
<template>
	<Head title="Профиль" />

	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				<Link :href="route('home')">Главная</Link>
				<span class="text-indigo-400 font-medium"> /</span>
				Профиль
			</h1>
		</template>
		<UpdateProfileRoleForm v-if="isAdmin" />
		<UpdateProfileSubdomainForm v-if="isAdmin || isManager"/>
		<UpdateProfileInformationForm />
		<UpdatePasswordForm v-if="isAdmin || isManager"/>
		<UpdateProfileThemeForm />
		<UpdateProfileLogotypeForm />
		<UpdateProfileContacts />
		<UpdateProfileSocialNetworksForm />
		<UpdateProfileWidgetForm />
		<UpdateProfileAboutForm />
		<UpdateProfileMetaForm />

		<!-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <DeleteUserForm class="max-w-xl" />
        </div> -->
	</DashboardLayout>
</template>
