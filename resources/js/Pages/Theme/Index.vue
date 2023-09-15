<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
  themes: {
    type: Array,
  },
});
</script>

<template>
  <Head title="Темы" />
  <DashboardLayout>
    <template #breadcrumbs>
      <h1>
        Темы
      </h1>
    </template>
    <Link class="btn_indigo" :href="route('themes.create')">
    <i class="fa-solid fa-plus btn-icon"></i>
    <span class="btn-label">Добавить</span>
    </Link>
    <div class="imageLinksList">
      <Link v-for="theme in themes" :href="route('themes.edit', theme.id)" class="imageLink"
        :style="'background-image: url(' + theme.background_thumb + ')'">
      </Link>
    </div>
  </DashboardLayout>
</template>
