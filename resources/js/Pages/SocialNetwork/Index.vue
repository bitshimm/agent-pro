<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
	social_networks: Array,
});
</script>
<template>
	<Head title="Новости" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				Социальные сети
			</h1>
		</template>
		<Link class="btn_indigo" :href="route('social-networks.create')">
		<!-- <span class="material-symbols-outlined btn-icon">add_circle</span> -->
		<i class="fa-solid fa-plus btn-icon"></i>
		<span class="btn-label">Добавить</span>
		</Link>
		<div class="data_table_wrapper">
			<table class="data_table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Название</th>
						<th>Иконка</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="social_network in social_networks">
						<td>
							<Link class="block social_network_icon"
								:href="route('social-networks.edit', social_network.id)">{{ social_network.id }}</Link>
						</td>
						<td>
							<Link class="block social_network_icon"
								:href="route('social-networks.edit', social_network.id)">{{ social_network.name }}</Link>
						</td>
						<td>
							<Link class="block social_network_icon" :href="route('social-networks.edit', social_network.id)"
								v-html="social_network.icon">
							</Link>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
</DashboardLayout></template>
