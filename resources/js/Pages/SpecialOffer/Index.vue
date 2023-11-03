<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps(['special_offers']);
</script>
<template>
	<Head title="Спец. предложения" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				Спец. предложения
			</h1>
		</template>
		<Link class="btn_indigo" :href="route('special-offers.create')">
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
						<th>Изображение</th>
						<th>Сортировка</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="specialOffer in special_offers">
						<td>
							<Link class="block" :href="route('special-offers.edit', specialOffer.id)">
							{{ specialOffer.title }}
							</Link>
						</td>
						<td>
							<Link class="block" :href="route('special-offers.edit', specialOffer.id)">
							<span v-if="specialOffer.visibility">Да</span>
							<span v-else>Нет</span>
							</Link>
						</td>
						<td>
							<a :href="specialOffer.image" target="_blank" class="underline">ссылка</a>
						</td>
						<td>
							<Link class="block" :href="route('special-offers.edit', specialOffer.id)">{{ specialOffer.sort
							}}</Link>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</DashboardLayout>
</template>
