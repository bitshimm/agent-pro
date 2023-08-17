<script setup>
import { usePage } from '@inertiajs/vue3';
import { watch, onMounted, computed } from 'vue';
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

const flash = computed(() => usePage().props.flash);
const toast = useToast();

onMounted(() => {
    if (flash.value.message) {
        openNotification(flash.value.message, flash.value.status);
    }
});

watch(flash, (newFlash) => {
    if (newFlash.message) {
        openNotification(newFlash.message, newFlash.type);
    }
});

function openNotification(message, status) {
    toast.open({
        message: message,
        type:  status,
        duration: 4000,
    });
}
</script>