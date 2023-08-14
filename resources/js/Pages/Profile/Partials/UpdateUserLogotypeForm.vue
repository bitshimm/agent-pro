<script setup>
import FileInput from '@/Components/FileInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const logotype = usePage().props.logotype;

const form = useForm({
    current_logotype: logotype,
    logotype: null,
    _method: 'patch',
});

const submit = () => {
    form.post(route('profile.logotype.update'), {
        // onSuccess: () => form.reset(),
    });
};

</script>
<template>
    <form class="form mb-5" @submit.prevent="submit">
        <div class="form-header">
            Логотип
        </div>
        <div class="form-items">
            <FileInput :label="form.current_logotype ? 'Заменить' : 'Добавить'" id="logotype" :error="form.errors.logotype" v-model="form.logotype" :current-image="form.current_logotype" />
        </div>
        <div class="form-bottom">
            <button type="submit" class="btn_indigo ml-auto">
                <i class="fa-solid fa-pen btn-icon"></i>
                <span class="btn-label">Обновить</span>
            </button>
        </div>
    </form>
</template>