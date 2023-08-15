<script setup>
import useAlerts from '@/Stores/useAlerts.vue';
import { usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { computed, watch } from 'vue';
const alertMsg = computed(() => usePage().props.flash.message);
const { addAlert, alerts, removeAlert } = useAlerts();
onMounted(() => {
    if (alertMsg.value) {
        addAlert(alertMsg.value);
    }
})
watch(alertMsg, (newVal) => {
    console.log(newVal);
    if (newVal) {
        addAlert(newVal);
    }
});
</script>
<template>
    <div v-if="alerts.length" class="alerts-list">
        <div v-for="alert in alerts" class="alert-item" @click="removeAlert(alert.id)">
            {{ alert.message }}
        </div>
    </div>
</template>
<style>
.alerts-list {
    font-family: 'Roboto', sans-serif;
    display: flex;
    flex-direction: column;
    gap: 10px;
    position: fixed;
    right: 0;
    bottom: 0;
    padding: 10px;
}

.alert-item {
    position: relative;
    padding: 1rem 3rem 1rem 1.5rem;
    background-color: #5661b3;
    color: #fff;
    font-weight: 700;
    border-radius: 6px;
    animation-duration: 300ms;
    animation-name: slideIn;
    animation-fill-mode: forwards;
    cursor: pointer;
}

@keyframes slideIn {
    from {
        transform: translateX(150%);
        opacity: 0;
    }

    75% {
        transform: translateX(-20%);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}
</style>