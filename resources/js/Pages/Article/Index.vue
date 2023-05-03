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
        <Link class="btn_create" :href="route('articles.create')">Добавить</Link>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Контент</th>
                    <!-- <th>Изображение</th> -->
                    <th width="10px"></th>
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
                        <Link class="block text-white bg-red-600 text-center" :href="route('articles.destroy', article.id)"
                            method="delete" as="button"><i class="fa-solid fa-trash"></i></Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </DashboardLayout>
</template>
