<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { useForm } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue';
import Checkbox from "@/Components/Checkbox.vue";
import { Link } from '@inertiajs/vue3';
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
        onFinish: () => form.reset(),
    });
};
</script>
<template>
    <Head title="Изображения" />
    <DashboardLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Изображения</h2>
        </template>
        <ul v-if="form.errors">
            <li v-for="error in form.errors" class="bg-red-100 text-red-900 p-2">
                {{ error }}
            </li>
        </ul>
        <form @submit.prevent="submit">
            <label for="image">Изображение:</label>
            <input type="file" @input="form.image = $event.target.files[0]" id="image" required autofocus />
            <label for="alt">Alt:</label>
            <TextInput id="alt" type="text" v-model="form.alt" />
            <label for="caption">Caption:</label>
            <TextInput id="caption" type="text" v-model="form.caption" />
            <label for="sort">Сортировка:</label>
            <TextInput id="sort" type="number" v-model="form.sort" min="0" />
            <label for="visibility">Видимость:</label>
            <Checkbox id="visibility" v-model:checked="form.visibility" />
            <button type="submit" class="btn_primary">
                <i class="fa-solid fa-plus btn-icon"></i>
                <span class="btn-label">Сохранить</span>
            </button>
        </form>

    </DashboardLayout>
</template>
