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
  <DashboardLayout>
    <h1>Картинки</h1>
    <div>
      <Link class="btn_primary" :href="route('images.create')">
        <!-- <span class="material-symbols-outlined btn-icon">add_circle</span> -->
        <i class="fa-solid fa-plus btn-icon"></i>
        <span class="btn-label">Добавить</span>
        </Link>
      <div v-for="image in images">
        <Link :href="route('images.edit', image.id)">
          <img :src="image.path_full" :alt="image.caption" width="300" height="200">
        </Link>
      </div>
    </div>
  </DashboardLayout>
</template>
