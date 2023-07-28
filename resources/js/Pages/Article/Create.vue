<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'

import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import NumberInput from '@/Components/NumberInput.vue';
import WysiwigTextarea from "@/Components/WysiwigTextarea.vue";
import Checkbox from "@/Components/Checkbox.vue";

const form = useForm({
    title: '',
    image: null,
    content: '',
    sort: 100,
    visibility: true
})

const submit = () => {
    form.post(route('articles.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>
<template>
    <Head title="Новости" />
    <DashboardLayout>
        <template #breadcrumbs>
            <h1>
                <Link :href="route('articles.index')">Новости</Link>
                <span class="text-indigo-400 font-medium">/</span> Добавление
            </h1>
        </template>
        <form @submit.prevent="submit" class="form">
            <div class="form-items">
                <ResourseTextInput label="Заголовок" id="title" :error="form.errors.title" v-model="form.title" autofocus />
                <FileInput label="Изображение" id="image" :error="form.errors.image" v-model="form.image" />
                <WysiwigTextarea label="Контент" id="content" :error="form.errors.content" :form="form" />
                <NumberInput label="Сортировка" id="sort" :error="form.errors.sort" v-model="form.sort" min="0" />
                <Checkbox label="Видимость" id="visibility" :error="form.errors.visibility"
                    v-model:checked="form.visibility" />
            </div>
            <div class="form-bottom">
                <button type="submit" class="btn_primary ml-auto">
                    <i class="fa-solid fa-plus btn-icon"></i>
                    <span class="btn-label">Добавить</span>
                </button>
            </div>
        </form>
    </DashboardLayout>
</template>
