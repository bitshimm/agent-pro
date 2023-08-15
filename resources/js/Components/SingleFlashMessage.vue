<script setup>
import { onMounted, ref } from "vue";

const props = defineProps({
    message: {
        type: String,
        required: true,
    }
});

const showMessage = ref(false);
const msgWrapper = ref();
onMounted(() => {
    // messages.value.push(props.message);
    // console.log(messages.value);
    msgWrapper.value.style.display = 'block';

    setTimeout(() => {
        showMessage.value = true;
    }, 1);

    setTimeout(() => {
        closeMessage();
    }, 5000);
});

function closeMessage() {
    showMessage.value = false;
    setTimeout(() => {
        msgWrapper.value.style.display = 'none';
    }, 300);
}
</script>
<template>
    <div class="flash-msg-wrapper" :class="{ show: showMessage }" ref="msgWrapper" @click="closeMessage">
        <div class="flash-msg-body">
            <div class="flash-msg-content">
                {{ message }}
            </div>
        </div>
    </div>
</template>
<style>
.flash-msg-wrapper {
    font-family: 'Roboto', sans-serif;
    position: fixed;
    right: 0;
    bottom: 0;
    padding: 10px;
    display: none;
    opacity: 0;
    transition: 300ms ease;
}

.flash-msg-wrapper.show {
    opacity: 1;
}

.flash-msg-wrapper .flash-msg-body {
    position: relative;
    padding: 1rem 3rem 1rem 1.5rem;
    background-color: #5661b3;
    color: #fff;
    font-weight: 700;
    border-radius: 6px;
    animation-duration: 300ms;
    animation-name: slideOut;
    animation-fill-mode: forwards;
    cursor: pointer;
}

.flash-msg-wrapper.show .flash-msg-body {
    animation-name: slideIn;
    animation-fill-mode: forwards;
}

.flash-msg-wrapper .flash-msg-body .flash-msg-content::after {
    content: '';
    position: absolute;
    right: 1.5rem;
    top: 50%;
    transform: translateY(-50%);
    display: block;
    width: 12px;
    height: 12px;
    background: no-repeat center url("data:image/svg+xml,%3Csvg width='32px' height='32px' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cg stroke-width='0'%3E%3C/g%3E%3Cg stroke-linecap='round' %3E%3C/g%3E%3Cg %3E%3Cpath d='M16 8L8 16M8.00001 8L16 16' stroke='%23ffffff' stroke-width='1.5' stroke-linecap='round' %3E%3C/path%3E%3C/g%3E%3C/svg%3E%0A");
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

@keyframes slideOut {
    from {
        transform: translateX(0);
        opacity: 1;
    }

    25% {
        transform: translateX(-20%);
    }

    to {
        opacity: 0;
        transform: translateX(100%);
    }
}
</style>