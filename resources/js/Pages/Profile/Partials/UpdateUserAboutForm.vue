<script setup>
import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import WysiwigTextarea from '@/Components/WysiwigTextarea.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const props = usePage().props;

const form = useForm({
    about_title: props.about_title,
    about_short_description: props.about_short_description,
    about_full_description: props.about_full_description,
});

const submit = () => {
    form.patch(route('profile.about.update'), {
        // onSuccess: () => form.reset(),
    });
};

</script>
<template>
    <form class="form mb-5" @submit.prevent="submit">
        <div class="form-header">
            О нас
        </div>
        <div class="form-items">
            <div class="form-item text-input" style="grid-column: 1 / -1;">
                <ResourseTextInput label="Заголовок" :error="form.errors.about_title" v-model="form.about_title" />
            </div>
            <div class="form-item text-input" style="grid-column: 1 / -1;">
                <label for="about_short_description" class="form-label">Короткое описание:</label>
                <textarea class="w-full block"
                    style="height: 200px; border-radius: 6px;border: 1px solid rgb(226, 232, 240);"
                    v-model="form.about_short_description" id="about_short_description"></textarea>
                <div v-if="form.errors.about_short_description" class="form-error">{{ form.errors.about_short_description }}</div>
            </div>
            <WysiwigTextarea label="Полное описание" style="grid-column: 1 / -1;" id="about_full_description" :error="form.errors.about_full_description" :form="form" v-model="form.about_full_description" />
        </div>
        <div class="form-bottom">
            <button type="submit" class="btn_indigo ml-auto">
                <i class="fa-solid fa-pen btn-icon"></i>
                <span class="btn-label">Обновить</span>
            </button>
        </div>
    </form>
</template>