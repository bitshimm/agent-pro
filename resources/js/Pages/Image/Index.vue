<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
  images: {
    type: Array,
  },
});
</script>

<template>
  <Head title="Изображения" />
  <DashboardLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Изображения</h2>
    </template>
    <Link class="btn_primary" :href="route('images.create')">
    <i class="fa-solid fa-plus btn-icon"></i>
    <span class="btn-label">Добавить</span>
    </Link>
    <div class="imageLinksList">
      <Link v-for="image in images" :href="route('images.edit', image.id)" class="imageLink"
        :style="'background-image: url(' + image.path_full + ')'">
      <div class="hover_text_wrapper">
        <span class="hover_text"> {{ image.caption }} </span>
      </div>
      </Link>
    </div>
  </DashboardLayout>
</template>
