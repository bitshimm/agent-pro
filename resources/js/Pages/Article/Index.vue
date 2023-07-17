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
    <DashboardLayout>

        <Link class="btn_primary" :href="route('articles.create')">
        <!-- <span class="material-symbols-outlined btn-icon">add_circle</span> -->
        <i class="fa-solid fa-plus btn-icon"></i>
        <span class="btn-label">Добавить</span>
        </Link>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Контент</th>
                    <!-- <th>Изображение</th> -->
                    <th></th>
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
                        <Link class="block" :href="route('articles.edit', article.id)">{{ article.id }}</Link>
                    </td>
                    <!-- <td>{{ article.image }}</td> -->
                    <td>
                        <!-- <Link class="btn_danger" :href="route('articles.destroy', article.id)" method="delete" as="button">
                            <i class="fa-solid fa-trash btn-icon"></i>
                            <span class="btn-label">Удалить</span>
                        </Link> -->
                    </td>
                </tr>
            </tbody>
        </table>
    </DashboardLayout>
</template>
