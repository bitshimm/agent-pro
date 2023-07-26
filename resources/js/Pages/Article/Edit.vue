<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3';

import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import NumberInput from '@/Components/NumberInput.vue';
import WysiwigTextarea from "@/Components/WysiwigTextarea.vue";
import Checkbox from "@/Components/Checkbox.vue";

const props = defineProps(['article']);

const form = useForm({
    title: props.article.title,
    content: props.article.content,
    sort: props.article.sort,
    visibility: Boolean(props.article.visibility),
    image: props.article.image,
    new_image: null,
    _method: 'patch',
})

const submit = () => {
    form.post(route('articles.update', props.article.id), {
        onSuccess: () => form.reset(),
    });
};
</script>
<template>
    <Head title="Новости" />
    <DashboardLayout>
        <template #header>
            <h1>Новости</h1>
        </template>
        <form @submit.prevent="submit" class="form">
            <div class="form-items">
                <ResourseTextInput label="Заголовок" id="title" :error="form.errors.title" v-model="form.title" />
                <div v-if="form.image">
                    <FileInput label="Заменить изображение" id="new_image" :error="form.errors.new_image"
                        v-model="form.new_image" :currentImage="form.image" />
                </div>
                <div v-else>
                    <FileInput label="Изображение" id="new_image" :error="form.errors.new_image"
                        v-model="form.new_image" />
                </div>
                <WysiwigTextarea label="Контент" id="content" :error="form.errors.content" :form="form" />
                <NumberInput label="Сортировка" id="sort" :error="form.errors.sort" v-model="form.sort" min="0" />
                <Checkbox label="Видимость" id="visibility" :error="form.errors.visibility"
                    v-model:checked="form.visibility" />
            </div>
            <div class="form-bottom">
                <Link class="btn_danger" :href="route('articles.destroy', article.id)" method="delete" as="button">
                <i class="fa-solid fa-trash btn-icon"></i>
                <span class="btn-label">Удалить</span>
                </Link>
                <button type="submit" class="btn_primary ml-auto">
                    <i class="fa-solid fa-check btn-icon"></i>
                    <span class="btn-label">Сохранить</span>
                </button>
            </div>
        </form>

    </DashboardLayout>
</template>
