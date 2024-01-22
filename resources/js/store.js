import { reactive } from 'vue'

export const store = reactive({
	sidebarCollapse: window.innerWidth <= 768
})