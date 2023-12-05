<script setup>
import Pagination from '@/Components/Pagination.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
	pages: Object,
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
						<th>Сортировка</th>
						<th>Активно</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="page in pages.data">
						<td>
							<Link class="block" :href="route('pages.edit', page.id)">{{ page.title }}</Link>
						</td>
						<td>
							<Link class="block" :href="route('pages.edit', page.id)">{{ page.sort }}</Link>
						</td>
						<td>
							<Link class="block" :href="route('pages.edit', page.id)">
							<span v-if="page.active">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
									stroke="currentColor" width="24" height="24" class="inline-block text-green-500"
									role="presentation">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
								</svg>
							</span>
							<span v-else>
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
									stroke="currentColor" width="24" height="24" class="inline-block text-red-500"
									role="presentation">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
								</svg>
							</span>
							</Link>
						</td>
						<td>
							<Link class="block" :href="route('pages.edit', page.id)">
							<Link class="px-2 py-1 text-white bg-red-700 rounded-md" :href="route('pages.destroy', page.id)"
								method="delete" as="button">
							<i class="fa-sm fa-solid fa-trash"></i>
							</Link>
							</Link>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<Pagination class="mt-6" :links="pages.links" />
	</DashboardLayout>
</template>
