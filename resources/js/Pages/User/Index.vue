<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
	users: {
		type: Array,
	},
});
</script>
<template>
	<Head title="Новости" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				Пользователи
			</h1>
		</template>
		<Link class="btn_indigo" :href="route('users.create')">
		<i class="fa-solid fa-plus btn-icon"></i>
		<span class="btn-label">Добавить</span>
		</Link>
		<div class="data_table_wrapper">
			<table class="data_table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Поддомен</th>
						<th>Имя</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="user in users">
						<td>
							<Link class="block" :href="route('users.edit', user.id)">{{ user.id }}</Link>
						</td>
						<td>
							<Link class="block" :href="route('users.edit', user.id)">{{ user.subdomain }}</Link>
						</td>
						<td>
							<Link class="block" :href="route('users.edit', user.id)">{{ user.name }}</Link>
						</td>
						<td>
							<Link class="block" :href="route('users.edit', user.id)">{{ user.email }}</Link>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</DashboardLayout>
</template>
