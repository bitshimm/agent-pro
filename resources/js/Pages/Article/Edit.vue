<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { useForm } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue';
import WysiwigTextarea from "@/Components/WysiwigTextarea.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
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
        <form @submit.prevent="submit">
            <label for="title">Заголовок:</label>
            <TextInput id="title" type="text" v-model="form.title" required autofocus />
            <div v-if="form.image">
                <label for="new_image">Заменить изображение:</label>
                <img :src="form.image" alt="" width="200">
                <input type="file" @input="form.new_image = $event.target.files[0]" id="new_image" />
            </div>
            <div v-else>
                <label for="new_image">Изображение:</label>
                <input type="file" @input="form.new_image = $event.target.files[0]" id="new_image" />
            </div>
            <label for="content">Контент:</label>
            <WysiwigTextarea id="content" :form="form" />
            <label for="sort">Сортировка:</label>
            <TextInput id="sort" type="number" v-model="form.sort" min="0" />
            <label for="visibility">Видимость:</label>
            <Checkbox id="visibility" v-model:checked="form.visibility" />
            <br>
            <div class="flex justify-between p-4">
                <button type="submit" class="btn_primary">
                    <i class="fa-solid fa-check btn-icon"></i>
                    <span class="btn-label">Сохранить</span>
                </button>
                <Link class="btn_danger" :href="route('articles.destroy', article.id)" method="delete" as="button">
                <i class="fa-solid fa-trash btn-icon"></i>
                <span class="btn-label">Удалить</span>
                </Link>
            </div>
        </form>

    </DashboardLayout>
</template>
