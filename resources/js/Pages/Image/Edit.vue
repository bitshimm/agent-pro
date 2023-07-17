<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { useForm } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue';
import Checkbox from "@/Components/Checkbox.vue";
import { Link } from '@inertiajs/vue3';
const props = defineProps(['image']);

const form = useForm({
    path_full: props.image.path_full,
    path_thumb: props.image.path_thumb,
    image: null,
    alt: props.image.alt,
    caption: props.image.caption,
    sort: props.image.sort,
    visibility: Boolean(props.image.visibility)
});

const submit = () => {
    form.post(route('images.update', props.image.id), {
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
            <div>
                <img :src="form.path_full" :alt="form.alt" style="width: 25%;">
            </div>
            <label for="image">Изображение:</label>
            <input type="file" @input="form.image = $event.target.files[0]" id="image" />
            <label for="alt">Alt:</label>
            <TextInput id="alt" type="text" v-model="form.alt" />
            <label for="caption">Caption:</label>
            <TextInput id="caption" type="text" v-model="form.caption" />
            <label for="sort">Сортировка:</label>
            <TextInput id="sort" type="number" v-model="form.sort" min="0" />
            <label for="visibility">Видимость:</label>
            <Checkbox id="visibility" v-model:checked="form.visibility" />
            <div class="flex justify-between p-4">
                <button type="submit" class="btn_primary">
                    <i class="fa-solid fa-check btn-icon"></i>
                    <span class="btn-label">Сохранить</span>
                </button>
                <Link class="btn_danger" :href="route('images.destroy', image.id)" method="delete" as="button">
                <i class="fa-solid fa-trash btn-icon"></i>
                <span class="btn-label">Удалить</span>
                </Link>
            </div>
        </form>

    </DashboardLayout>
</template>
