<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
    articles: {
        type: Array,
    },
});
</script>
<template>
    <Head title="Новости" />
    <DashboardLayout>
        <template #breadcrumbs>
            <h1>
                Новости
            </h1>
        </template>
        <Link class="btn_indigo" :href="route('articles.create')">
        <!-- <span class="material-symbols-outlined btn-icon">add_circle</span> -->
        <i class="fa-solid fa-plus btn-icon"></i>
        <span class="btn-label">Добавить</span>
        </Link>
        <div class="data_table_wrapper">
            <table class="data_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Заголовок</th>
                        <th>Активно</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="article in articles">
                        <td>
                            <Link class="block" :href="route('articles.edit', article.id)">{{ article.id }}</Link>
                        </td>
                        <td>
                            <Link class="block" :href="route('articles.edit', article.id)">{{ article.title }}</Link>
                        </td>
                        <td>
                            <Link class="block" :href="route('articles.edit', article.id)">
                                <span v-if="article.visibility">Да</span>
                                <span v-else>Нет</span>
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </DashboardLayout>
</template>
