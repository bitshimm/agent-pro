<script setup>
import Icon from '@/Components/Icon.vue';
import Pagination from '@/Components/Pagination.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
	articles: Object,
});
</script>
<template>
	<Head title="Новости" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				Новости
			</h1>
		</template>
		<Link class="btn_indigo" :href="route('articles.create')">
		<!-- <span class="material-symbols-outlined btn-icon">add_circle</span> -->
		<i class="fa-solid fa-plus btn-icon"></i>
		<span class="btn-label">Добавить</span>
		</Link>
		<div class="data_table_wrapper">
			<table class="data_table">
				<thead>
					<tr>
						<th>Заголовок</th>
						<th>Изображение</th>
						<th>Сортировка</th>
						<th>Активно</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="article in articles.data">
						<td>
							<Link class="block" :href="route('articles.edit', article.id)">{{ article.title }}</Link>
						</td>
						<td>
							<a :href="article.image" v-if="article.image" target="_blank" class="underline">ссылка</a>
						</td>
						<td>
							<Link class="block" :href="route('articles.edit', article.id)">{{ article.sort }}</Link>
						</td>
						<td>
							<Link class="block" :href="route('articles.edit', article.id)">
							<span v-if="article.active">
								<Icon id="success" width="24" height="24" currentColor="text-green-500" />
							</span>
							<span v-else>
								<Icon id="error" width="24" height="24" currentColor="text-red-500" />
							</span>
							</Link>
						</td>
						<td>
							<Link class="block" :href="route('articles.edit', article.id)">
							<div class="flex gap-x-4 justify-end">
								<Link class="px-2 py-2 rounded-md bg-red-100" :href="route('articles.edit', article.id)"
									as="button">
								<Icon id="edit" width="20" height="20" currentColor="text-slate-700" />
								</Link>
								<Link class="px-2 py-2 rounded-md bg-red-100" :href="route('articles.destroy', article.id)"
									method="delete" as="button">
								<Icon id="trash" width="20" height="20" currentColor="text-slate-700" />
								</Link>
							</div>
							</Link>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<Pagination class="mt-6" :links="articles.links" />
	</DashboardLayout>
</template>
