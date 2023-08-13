<script setup>
import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import PhoneInput from "@/Components/PhoneInput.vue";
import { useForm, usePage } from '@inertiajs/vue3';

const props = usePage().props;

const form = useForm({
    contact_phone: props.contact_phone,
    contact_phone_second: props.contact_phone_second,
    contact_email: props.contact_email,
    contact_address: props.contact_address,
    contact_opening_hours: props.contact_opening_hours,
});

const submit = () => {
    form.patch(route('profile.contacts.update'), {
        // onSuccess: () => form.reset(),
    });
};
</script>
<template>
    <form class="form mb-5" @submit.prevent="submit">
        <div class="form-header">
            Контакты
        </div>
        <div class="form-items">
            
            <div class="form-item text-input">
                <PhoneInput id="contact_phone" label="Контактый телефон" :error="form.errors.contact_phone" v-model="form.contact_phone" />
            </div>
            <div class="form-item text-input">
                <PhoneInput id="contact_phone_second" label="Контактый телефон (дополнительный)" :error="form.errors.contact_phone_second" v-model="form.contact_phone_second" />
            </div>
            <div class="form-item text-input">
                <ResourseTextInput id="contact_email" label="Контактый email" :error="form.errors.contact_email" v-model="form.contact_email" type="email" />
            </div>
            <div class="form-item text-input">
                <ResourseTextInput id="contact_address" label="Контактный адрес" :error="form.errors.contact_address" v-model="form.contact_address" />
            </div>
            <div class="form-item text-input">
                <ResourseTextInput id="contact_opening_hours" label="Часы работы" :error="form.errors.contact_opening_hours" v-model="form.contact_opening_hours" />
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