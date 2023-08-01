<script setup>
import ResourseTextInput from '@/Components/ResourseTextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { onBeforeMount } from 'vue';


const social_networks = usePage().props.social_networks;
const user_social_networks = usePage().props.user_social_networks;

const form = useForm({
    user_social_networks: {}
});
onBeforeMount(() => {
    user_social_networks.map((user_social_network) => {
        form.user_social_networks[user_social_network.pivot.social_network_id] = user_social_network.pivot.link
    })
})
const submit = () => {
    form.patch(route('profile.social-networks.update'), {
        // onSuccess: () => form.reset(),
    });
};

</script>
<template>
    <!-- <div class="div" v-for="social_network in user_social_networks">
        <a :href="social_network.pivot.link" target="_blank" v-html="social_network.icon"></a>
    </div> -->
    <form class="form mb-5" @submit.prevent="submit">
        <div class="form-header">
            Социальные сети
        </div>
        <div class="form-items">
            <div class="form-item text-input" v-for="social_network in social_networks">
                <ResourseTextInput :label="social_network.name" :id="'social_network_' + social_network.id" v-model="form.user_social_networks[social_network.id]" />
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