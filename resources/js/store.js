import axios from 'axios';
import { reactive } from 'vue'

export const store = reactive({
	sidebarCollapse: window.innerWidth <= 768,
	hasDifferences: false,
	websiteExists: false,
});

export const checkDifference = () => {
	axios.get(route('site.checkDifference'))
		.then(response => response.data).then(data => {
			store.hasDifferences = data.different;
		});
}

export const websiteAvailability = (subdomain) => {
	axios.get(route('profile.websiteAvailability'))
		.then(response => response.data)
		.then(data => {
			if (data.status == 'success') {
				store.websiteExists = true;
			} else {
				store.websiteExists = false;
			}
		});
}