<script setup>
import { usePage } from '@inertiajs/vue3';
import { watch, onMounted, computed } from 'vue';
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

const flash = computed(() => usePage().props.flash);
const errors = computed(() => usePage().props.errors);
const toast = useToast();

onMounted(() => {
    if (flash.value.message) {
        openNotification(flash.value.message, flash.value.status);
    }
});

watch(flash, (newFlash) => {
    if (newFlash.message) {
        openNotification(newFlash.message, newFlash.status);
    }
});

watch(errors, (newErrors) => {
    if (Object.keys(newErrors).length !== 0) {
        openNotification('Произошла ошибка при отправке формы', 'error');
    }
});

function openNotification(message, status) {
    toast.open({
        message: message,
        type: status,
        duration: 4000,
    });
}
</script>