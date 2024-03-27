<script setup>
import Icon from '@/Components/Icon.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
	images: Array,
});
</script>

<template>
	<Head title="Галерея" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				Галерея
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
			<Link class="absolute -top-1.5 -right-1.5 px-2 py-2 rounded-full bg-red-100 border-gray-100 border-2"
				:href="route('images.destroy', image.id)" method="delete" as="button">
			<Icon id="trash" width="20" height="20" currentColor="text-slate-700" />
			</Link>
			</Link>
		</div>
	</DashboardLayout>
</template>
