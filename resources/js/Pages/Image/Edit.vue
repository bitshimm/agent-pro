<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3';

import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import NumberInput from '@/Components/NumberInput.vue';
import Checkbox from "@/Components/Checkbox.vue";

const props = defineProps(['image']);

const form = useForm({
    path_full: props.image.path_full,
    path_thumb: props.image.path_thumb,
    image: null,
    alt: props.image.alt,
    caption: props.image.caption,
    sort: props.image.sort,
    visibility: Boolean(props.image.visibility),
    _method: 'patch',
});

const submit = () => {
    form.post(route('images.update', props.image.id), {
        onSuccess: () => form.reset(),
    });
};
</script>
<template>
    <Head title="Изображения" />
    <DashboardLayout>
        <template #breadcrumbs>
            <h1>
                <Link :href="route('articles.index')">Изображения</Link>
                <span class="text-indigo-400 font-medium"> /</span>
                {{ form.caption }}
            </h1>
        </template>
        <form @submit.prevent="submit" class="form">
            <div class="form-items">
                <FileInput label="Заменить изображение" id="image" :error="form.errors.image" v-model="form.image" :currentImage="form.path_full" />
                <div class="form-item text-input">
                    <ResourseTextInput label="Alt" id="alt" :error="form.errors.alt" v-model="form.alt" />
                </div>
                <div class="form-item text-input">
                    <ResourseTextInput label="Caption" id="caption" :error="form.errors.caption" v-model="form.caption" />
                </div>
                <NumberInput label="Сортировка" id="sort" :error="form.errors.sort" v-model="form.sort" min="0" />
                <Checkbox label="Видимость" id="visibility" :error="form.errors.visibility"
                    v-model:checked="form.visibility" />
            </div>
            <div class="form-bottom">
                <Link class="btn_danger" :href="route('images.destroy', props.image.id)" method="delete" as="button">
                <i class="fa-solid fa-trash btn-icon"></i>
                <span class="btn-label">Удалить</span>
                </Link>
                <button type="submit" class="btn_indigo ml-auto">
                    <i class="fa-solid fa-check btn-icon"></i>
                    <span class="btn-label">Сохранить</span>
                </button>
            </div>
        </form>
    </DashboardLayout>
</template>
