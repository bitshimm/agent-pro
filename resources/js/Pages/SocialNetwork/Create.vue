<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'

import ResourseTextInput from '@/Components/ResourseTextInput.vue';

const form = useForm({
    name: '',
    icon: '',
})

const submit = () => {
    form.post(route('social-networks.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>
<template>
    <Head title="Новости" />
    <DashboardLayout>
        <template #breadcrumbs>
            <h1>
                <Link :href="route('social-networks.index')">Социальные сети</Link>
                <span class="text-indigo-400 font-medium"> /</span>
                Создание
            </h1>
        </template>
        <form @submit.prevent="submit" class="form">
            <div class="form-items">
                <div class="form-item text-input">
                    <ResourseTextInput label="Название" id="name" :error="form.errors.name" v-model="form.name" autofocus required />
                </div>
                <div class="form-item text-input">
                    <ResourseTextInput label="Иконка" id="icon" :error="form.errors.icon" v-model="form.icon" required />
                </div>
            </div>
            <div class="py-3">
                <div>
                    Иконка: <span v-html="form.icon"></span>
                </div>
            </div>
            <div class="form-bottom">
                <button type="submit" class="btn_indigo ml-auto">
                    <i class="fa-solid fa-plus btn-icon"></i>
                    <span class="btn-label">Добавить</span>
                </button>
            </div>
        </form>
    </DashboardLayout>
</template>
