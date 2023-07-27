<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, useForm } from '@inertiajs/vue3'

import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import NumberInput from '@/Components/NumberInput.vue';
import Checkbox from "@/Components/Checkbox.vue";

const props = defineProps(['image']);

const form = useForm({
    image: null,
    alt: '',
    caption: '',
    sort: 100,
    visibility: true,
});

const submit = () => {
    form.post(route('images.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>
<template>
    <Head title="Изображения" />
    <DashboardLayout>
        <template #header>
            <h1>Изображения</h1>
        </template>
        <form @submit.prevent="submit" class="form">
            <div class="form-items">
                <FileInput label="Изображение" id="image" :error="form.errors.image" v-model="form.image" />
                <ResourseTextInput label="Alt" id="alt" :error="form.errors.alt" v-model="form.alt" />
                <ResourseTextInput label="Caption" id="caption" :error="form.errors.caption" v-model="form.caption" />
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
