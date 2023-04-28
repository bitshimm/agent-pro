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
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <!-- <th>Изображение</th> -->
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="article in articles">
                    <td>{{ article.id }}</td>
                    <td>{{ article.title }}</td>
                    <!-- <td>{{ article.image }}</td> -->
                    <td></td>
                </tr>
            </tbody>
        </table>
    </DashboardLayout>
</template>
