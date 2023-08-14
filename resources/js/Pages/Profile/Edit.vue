<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, Link } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import UpdateUserSocialNetworksForm from './Partials/UpdateUserSocialNetworksForm.vue';
import UpdateUserWidgetForm from './Partials/UpdateUserWidgetForm.vue';
import UpdateUserAboutForm from './Partials/UpdateUserAboutForm.vue';
import UpdateUserContacts from './Partials/UpdateUserContactsForm.vue';
import UpdateUserLogotypeForm from './Partials/UpdateUserLogotypeForm.vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Профиль" />

    <DashboardLayout>
        <template #breadcrumbs>
            <h1>
                <Link :href="route('home')">Главная</Link>
                <span class="text-indigo-400 font-medium"> /</span>
                {{ $page.props.auth.user.name }}
            </h1>
        </template>
        <UpdateUserLogotypeForm />
        <UpdateUserContacts />
        <UpdateUserSocialNetworksForm />
        <UpdateUserWidgetForm />
        <UpdateUserAboutForm />

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" class="max-w-xl" />
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <UpdatePasswordForm class="max-w-xl" />
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <DeleteUserForm class="max-w-xl" />
        </div>

    </DashboardLayout>
</template>
