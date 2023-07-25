<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { useForm } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue';
import WysiwigTextarea from "@/Components/WysiwigTextarea.vue";
import Checkbox from "@/Components/Checkbox.vue";

import NewTextInput from '@/Components/NewTextInput.vue';
import NewFileInput from '@/Components/NewFileInput.vue';
import NewNumberInput from '@/Components/NewNumberInput.vue';

const form = useForm({
    title: '',
    image: null,
    content: '',
    sort: 100,
    visibility: true
})

const submit = () => {
    form.post(route('articles.store'), {
        onFinish: () => form.reset(),
    });
};
</script>
<template>
    <Head title="Новости" />
    <DashboardLayout>
        <template #header>
            <h1>Новости</h1>
        </template>
        <ul v-if="form.errors">
            <li v-for="error in form.errors" class="bg-red-100 text-red-900 p-2">
                {{ error }}
            </li>
        </ul>
        <form @submit.prevent="submit" class="form-group">
            <NewTextInput label="Заголовок" id="title" :error="form.errors.title" v-model="form.title" />
            <NewFileInput label="Изображение" id="image" :error="form.errors.image" v-model="form.image" />
            <NewNumberInput label="Сортировка" id="sort" :error="form.errors.sort" v-model="form.sort" min="0" />
            <label for="content">Контент:</label>
            <WysiwigTextarea id="content" :form="form" />
            <label for="visibility">Видимость:</label>
            <Checkbox id="visibility" v-model:checked="form.visibility" />
            <br>
            <button type="submit" class="btn_primary">
                <i class="fa-solid fa-plus btn-icon"></i>
                <span class="btn-label">Сохранить</span>
            </button>
        </form>
    </DashboardLayout>
</template>
