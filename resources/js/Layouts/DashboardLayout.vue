<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted, watch, computed } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ToastNotifications from '@/Components/ToastNotifications.vue';

const isAdmin = usePage().props.auth.isAdmin;
const isManager = usePage().props.auth.isManager;
const site = usePage().props.site;
const windowWidth = ref(window.innerWidth);
const sidebarCollapse = ref(windowWidth.value <= 768);
const onSidebar = ref(false);

const activeRoute = {
	themes: route().current('themes.*'),
	articles: route().current('articles.*'),
	pages: route().current('pages.*'),
	images: route().current('images.*'),
	social_networks: route().current('social-networks.*'),
	special_offers: route().current('special-offers.*'),
	users: route().current('users.*'),
};

onMounted(() => {
	window.addEventListener('resize', () => {
		windowWidth.value = window.innerWidth
		if (windowWidth.value <= 768) {
			sidebarCollapse.value = true;
		}
	});
});

onUnmounted(() => {
	window.removeEventListener('resize', () => { windowWidth.value = window.innerWidth })
});
</script>
<template>
	<ToastNotifications />
	<div class="wrapper" :class="{ sidebar_collapse: sidebarCollapse, on_sidebar: onSidebar }">
		<div id="sidebar_overlay" @click="sidebarCollapse = !sidebarCollapse;"></div>
		<nav class="main_header">
			<ul class="navbar_nav">
				<li class="nav_item">
					<a class="nav_link" href="#" id="menu-toggler" @click="sidebarCollapse = !sidebarCollapse">
						<i class="fas fa-lg fa-bars"></i>
					</a>
				</li>

				<li class="nav_item mt-auto">
					<a :href="route('site.preview')" class="nav_link" target="_blank">
						<i class="nav_icon fa-solid fa-eye mr-2"></i>
						<span class="nav_title">Предпросмотр</span>
					</a>
				</li>
				<li class="nav_item">
					<Link :href="route('site.publish')" class="nav_link">
					<i class="nav_icon fa-solid fa-upload mr-2"></i>
					<span class="nav_title">Опубликовать</span>
					</Link>
				</li>
				<li class="nav_item">
					<a :href="site.url" class="nav_link" target="_blank">
						<i class="nav_icon fa-solid fa-globe mr-2"></i>
						<span class="nav_title">Перейти на сайт</span>
					</a>
				</li>

				<li class="nav_item ml-auto">
					<Dropdown align="right" width="48">
						<template #trigger>
							<span class="inline-flex rounded-md">
								<button type="button"
									class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
									{{ $page.props.auth.user.name }}

									<svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
										fill="currentColor">
										<path fill-rule="evenodd"
											d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
											clip-rule="evenodd" />
									</svg>
								</button>
							</span>
						</template>

						<template #content>
							<DropdownLink :href="route('profile.edit')"> Профиль </DropdownLink>
							<DropdownLink :href="route('logout')" method="post" as="button">
								Выйти
							</DropdownLink>
						</template>
					</Dropdown>
				</li>
			</ul>

		</nav>
		<aside class="main_sidebar" v-on:mouseenter="onSidebar = !onSidebar" v-on:mouseleave="onSidebar = !onSidebar">
			<div class="user_panel">
				<!-- <Link :href="route('profile.edit')" class="nav_link" :class="{ active: activeRoute.articles }">
                <i class="nav_icon fa-solid fa-user"></i>
                <span class="nav_title">{{ $page.props.auth.user.name }}</span>
                </Link> -->
				<Link :href="route('home')" class="nav_link">
				<!-- <i class="nav_icon fa-solid fa-circle-nodes fa-spin fa-2xl"></i> -->
				<i class="nav_icon fa-brands fa-battle-net" style="font-size:23px;color: #B2B7FF;"></i>
				<!-- <i class="nav_icon fa-solid fa-user"></i> -->
				<span class="nav_title text-2xl">test</span>
				</Link>
			</div>
			<nav>
				<ul class="nav">
					<li class="nav_item" v-if="isAdmin">
						<Link :href="route('themes.index')" class="nav_link" :class="{ active: activeRoute.themes }">
						<i class="nav_icon fa-solid fa-paint-roller"></i>
						<span class="nav_title">Темы</span>
						</Link>
					</li>
					<li class="nav_item" v-if="isAdmin || isManager">
						<Link :href="route('users.index')" class="nav_link" :class="{ active: activeRoute.users }">
						<i class="nav_icon fa-solid fa-users"></i>
						<span class="nav_title">Пользователи</span>
						</Link>
					</li>
					<li class="nav_item">
						<Link :href="route('articles.index')" class="nav_link" :class="{ active: activeRoute.articles }">
						<i class="nav_icon fa-solid fa-newspaper"></i>
						<span class="nav_title">Новости</span>
						</Link>
					</li>
					<li class="nav_item">
						<Link :href="route('pages.index')" class="nav_link" :class="{ active: activeRoute.pages }">
						<i class="nav_icon fa-solid fa-tablet"></i>
						<span class="nav_title">Страницы</span>
						</Link>
					</li>
					<li class="nav_item">
						<Link :href="route('special-offers.index')" class="nav_link"
							:class="{ active: activeRoute.special_offers }">
						<i class="nav_icon fa-solid fa-newspaper"></i>
						<span class="nav_title">Спец. предложения</span>
						</Link>
					</li>
					<li class="nav_item">
						<Link :href="route('images.index')" class="nav_link" :class="{ active: activeRoute.images }">
						<i class="nav_icon fa-solid fa-image"></i>
						<span class="nav_title">Изображения</span>
						</Link>
					</li>
					<li class="nav_item" v-if="isAdmin">
						<Link :href="route('social-networks.index')" class="nav_link"
							:class="{ active: activeRoute.social_networks }">
						<i class="nav_icon fa-solid fa-circle-nodes"></i>
						<span class="nav_title">Социальные сети</span>
						</Link>
					</li>
					<li class="nav_item">
						<Link :href="route('filemanager')" class="nav_link">
						<i class="nav_icon fa-solid fa-file"></i>
						<span class="nav_title">Файловый менеджер</span>
						</Link>
					</li>
				</ul>
			</nav>
		</aside>

		<div class="content_wrapper">
			<!-- Page Heading -->
			<header v-if="$slots.header">
				<slot name="header" />
			</header>

			<!-- Page Content -->
			<div class="content">
				<div class="breadcrumbs" v-if="$slots.breadcrumbs">
					<slot name="breadcrumbs" />
				</div>
				<slot />
			</div>
		</div>
	</div>
</template>