<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
	images: Array,
});
</script>

<template>
	<Head title="Изображения" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				Изображения
			</h1>
		</template>
		<Link class="btn_indigo" :href="route('images.create')">
		<i class="fa-solid fa-plus btn-icon"></i>
		<span class="btn-label">Добавить</span>
		</Link>
		<div class="imageLinksList">
			<Link v-for="image in images" :href="route('images.edit', image.id)" class="imageLink relative"
				:style="'background-image: url(' + image.path_full + ')'">
			<div class="hover_text_wrapper">
				<span class="hover_text"> {{ image.caption }} </span>
			</div>
			<Link class="absolute -top-1.5 -right-1.5 rounded-full w-8 h-8 bg-red-600 text-white border-white border-2"
				:href="route('images.destroy', image.id)" method="delete" as="button">
			<i class="fa-solid fa-trash "></i>
			</Link>
			</Link>
		</div>
	</DashboardLayout>
</template>
