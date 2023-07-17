<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
  images: {
    type: Array,
  },
});

</script>
<style>
.imageLinksList {
  display:grid; 
  grid-gap: 1rem;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
}
.imageLink {
  height: 200px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.hover_text_wrapper {
  display: flex;
  width: 100%;
  height: 100%;
  opacity: 0;
  color: #fff;
}
.hover_text {
  margin: auto;
}
.hover_text_wrapper:hover {
  background-color: rgba(30, 30, 30, 0.5);
  opacity: 1;
  transition: ease-in 0.15s;
}
</style>
<template>
  <DashboardLayout>
    <h1>Картинки</h1>
    <Link class="btn_primary" :href="route('images.create')">
    <i class="fa-solid fa-plus btn-icon"></i>
    <span class="btn-label">Добавить</span>
    </Link>
    <div class="imageLinksList">
      <Link v-for="image in images" :href="route('images.edit', image.id)" class="imageLink"
        :style="'background-image: url(' + image.path_full + ')'">
        <div class="hover_text_wrapper">
          <span class="hover_text">
            {{ image.caption }}
          </span>
        </div>
      </Link>
    </div>
  </DashboardLayout>
</template>
