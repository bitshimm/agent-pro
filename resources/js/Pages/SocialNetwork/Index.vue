<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
    social_networks: {
        type: Array,
    },
});
</script>
<template>
    <Head title="Новости" />
    <DashboardLayout>
        <template #breadcrumbs>
            <h1>
                Социальные сети
            </h1>
        </template>
        <Link class="btn_primary" :href="route('social_networks.create')">
        <!-- <span class="material-symbols-outlined btn-icon">add_circle</span> -->
        <i class="fa-solid fa-plus btn-icon"></i>
        <span class="btn-label">Добавить</span>
        </Link>
        <div class="data_table_wrapper">
            <table class="data_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Иконка</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="social_network in social_networks">
                        <td>
                            <Link class="block" :href="route('social_networks.edit', social_network.id)">{{ social_network.id }}</Link>
                        </td>
                        <td>
                            <Link class="block" :href="route('social_networks.edit', social_network.id)">{{ social_network.name }}</Link>
                        </td>
                        <td>
                            <Link class="block" :href="route('social_networks.edit', social_network.id)">{{ social_network.icon }}</Link>
                        </td>
                        <td>
                            <!-- <Link class="btn_danger" :href="route('articles.destroy', article.id)" method="delete"
                                as="button">
                            <i class="fa-solid fa-trash btn-icon"></i>
                            <span class="btn-label">Удалить</span>
                            </Link> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </DashboardLayout>
</template>
