<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
	<Head title="Главная" />
	<DashboardLayout>
		<template #breadcrumbs>
			<h1>
				Главная
			</h1>
		</template>
	</DashboardLayout>
</template>
