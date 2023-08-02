<script setup>
import { useForm, usePage } from '@inertiajs/vue3';

const widget = usePage().props.widget;

const form = useForm({
    widget: widget
});

const submit = () => {
    form.patch(route('profile.widget.update'), {
        // onSuccess: () => form.reset(),
    });
};

</script>
<template>
    <form class="form mb-5" @submit.prevent="submit">
        <div class="form-header">
            Виджет
        </div>
        <div class="form-items">
            <div class="form-item text-input" style="grid-column: 1 / -1;">
                <label for="widget" class="form-label">Вставьте код:</label>
                <textarea class="w-full block" style="resize: none; height: 200px; border-radius: 6px;border: 1px solid rgb(226, 232, 240);" v-model="form.widget" id="widget"></textarea>
                <div v-if="form.errors.widget" class="form-error">{{ form.errors.widget }}</div>
            </div>
        </div>
        <div class="form-bottom">
            <button type="submit" class="btn_indigo ml-auto">
                <i class="fa-solid fa-pen btn-icon"></i>
                <span class="btn-label">Обновить</span>
            </button>
        </div>
    </form>
</template>