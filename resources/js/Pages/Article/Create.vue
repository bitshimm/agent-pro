<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { useForm } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue';
import WysiwigTextarea from "@/Components/WysiwigTextarea.vue";

const form = useForm({
    title: '',
    content: '',
    sort: 100,
    visibility: 1
})

const submit = () => {
    console.log(form);
    form.post(route('articles.store'), {
        onFinish: () => form.reset(),
    });
};
</script>
<template>
    <DashboardLayout>
        <ul v-if="form.errors">
            <li v-for="error in form.errors" class="bg-red-100 text-red-900 p-2">
                {{ error }}
            </li>
        </ul>
        <form @submit.prevent="submit">
            <label for="title">Title:</label>
            <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus />
            <label for="content">Content:</label>
            <WysiwigTextarea id="content" :form="form" />
            <label for="sort">Sort:</label>
            <input id="sort" v-model="form.sort" />
            <label for="visibility">Visibility:</label>
            <input id="visibility" v-model="form.visibility" />
            <button type="submit">Submit</button>
        </form>
    </DashboardLayout>
</template>
