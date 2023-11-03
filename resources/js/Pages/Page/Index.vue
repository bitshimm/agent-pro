<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
	pages: {
		type: Array,
	},
});
</script>
<template>
	<Head title="Новости" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				Страницы
			</h1>
		</template>
		<Link class="btn_indigo" :href="route('pages.create')">
		<!-- <span class="material-symbols-outlined btn-icon">add_circle</span> -->
		<i class="fa-solid fa-plus btn-icon"></i>
		<span class="btn-label">Добавить</span>
		</Link>
		<div class="data_table_wrapper">
			<table class="data_table">
				<thead>
					<tr>
						<th>Заголовок</th>
						<th>Активно</th>
						<th>Сортировка</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="page in pages">
						<td>
							<Link class="block" :href="route('pages.edit', page.id)">{{ page.title }}</Link>
						</td>
						<td>
							<Link class="block" :href="route('pages.edit', page.id)">
							<span v-if="page.visibility">Да</span>
							<span v-else>Нет</span>
							</Link>
						</td>
						<td>
							<Link class="block" :href="route('pages.edit', page.id)">{{ page.sort }}</Link>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</DashboardLayout>
</template>
