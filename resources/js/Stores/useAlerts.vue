<script>
import {ref} from "vue";

const alerts = ref([]);

export default function useAlerts() {
    
    const removeAlert = (id) => {
        alerts.value = alerts.value.filter(alert => alert.id !== id);
    };

    const addAlert = (alert) => {
        const id = new Date().getTime();

        console.log(alerts.value);
        alerts.value.push({
            id: id,
            message: alert
        });

        setTimeout(() => {
            removeAlert(id)
        }, 3000);
    };

    return {
        alerts,
        addAlert,
        removeAlert
    }
}
</script>