<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
const windowWidth = ref(window.innerWidth)
const sidebarCollapse = ref(windowWidth.value <= 768);
const onSidebar = ref(false);

const activeRoute = {
    articles: route().current('articles.*'),
    images: route().current('images.*'),
};
onMounted(() => {
    window.addEventListener('resize', () => {
        windowWidth.value = window.innerWidth
        if (windowWidth.value <= 768) {
            sidebarCollapse.value = true;
        }
    });
})
onUnmounted(() => {
    window.removeEventListener('resize', () => { windowWidth.value = window.innerWidth })
})
</script>

<template>
    <div class="wrapper" :class="{ sidebar_collapse: sidebarCollapse, on_sidebar: onSidebar }">
        <div id="sidebar_overlay" @click="sidebarCollapse = !sidebarCollapse;"></div>
        <nav class="main_header">
            <ul class="navbar_nav">
                <li class="nav_item">
                    <a class="nav_link" href="#" id="menu-toggler" @click=" sidebarCollapse = !sidebarCollapse ">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav_item">
                    <Link class="nav_link">
                    <span class="nav_title">Home</span>
                    </Link>
                </li>
                <li class="nav_item">
                    <Link class="nav_link">
                    <span class="nav_title">Contact</span>
                    </Link>
                </li>
            </ul>
        </nav>
        <aside class="main_sidebar" v-on:mouseenter=" onSidebar = !onSidebar " v-on:mouseleave=" onSidebar = !onSidebar ">
            <nav>
                <ul class="nav">
                    <li class="nav_item">
                        <Link :href=" route('articles.index') " class="nav_link"  :class="{ active: activeRoute.articles }">
                        <i class="nav_icon fa-solid fa-newspaper"></i>
                        <span class="nav_title">Новости</span>
                        </Link>
                    </li>
                    <li class="nav_item">
                        <Link :href=" route('images.index') " class="nav_link"  :class="{ active: activeRoute.images }">
                        <i class="nav_icon fa-solid fa-image"></i>
                        <span class="nav_title">Изображения</span>
                        </Link>
                    </li>
                    <div class="nav_item">
                        <a href="" class="nav_link">
                            <i class="nav_icon fa-solid fa-share-nodes"></i>
                            <span class="nav_title">Social</span>
                        </a>
                    </div>
                </ul>
            </nav>
        </aside>
        <div class="content_wrapper">
            <div class="content_header">

            </div>
            <div class="content">
                <slot />
            </div>
        </div>
    </div>
</template>
