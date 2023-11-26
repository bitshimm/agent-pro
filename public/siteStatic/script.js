const TRANSITION_DELAY = 300;

document.addEventListener("DOMContentLoaded", function () {
	initTheme();
	initCallbackForms();
	initSpecialOffers();
	initModals();
	initFancybox();
	initImagesSplideSlider();
	initNavbarToggler();
	// initImagesSwiperSlider();
	// initImagesGlideSlider();
});

function initNavbarToggler() {
	const navbarToggler = document.querySelector('.navbar-toggler');

	navbarToggler.addEventListener('click', () => {
		const collapseBlock = document.querySelector('.navbar-collapse');

		if (collapseBlock.classList.contains('show')) {
			collapseBlock.classList.remove('show');
			collapseBlock.style.maxHeight = null;
		} else {
			collapseBlock.classList.add('show');
			collapseBlock.style.maxHeight = collapseBlock.scrollHeight + 'px';
		}
		initImagesSplideSlider();
	});
}

function initImagesSplideSlider() {
	const splide = new Splide('.splide', {
		type: 'loop',
		perPage: 5,
		gap: '16px',
		perMove: 1,
		pagination: false,
		breakpoints: {
			1280: {
				perPage: 4,
			},
			992: {
				perPage: 3,
			},
			640: {
				perPage: 2,
			},
			460: {
				perPage: 1,
			},
		},
	});
	splide.on('overflow', function (isOverflow) {
		// Reset the carousel position
		splide.go(0);

		splide.options = {
			arrows: isOverflow,
			drag: isOverflow,
			clones: isOverflow ? undefined : 0, // Toggle clones
		};
	});

	splide.mount();
}

function initFancybox() {
	Fancybox.bind('[data-fancybox="images"]', {
		Thumbs: false,
		Toolbar: {
			display: {
				left: [],
				middle: [],
				right: ["download", "close"],
			},
		},
	});
}

function initImagesSwiperSlider() {
	const swiper = new Swiper('.swiper', {
		// loop: true,
		spaceBetween: 16,
		slidesPerView: 1,
		breakpoints: {
			460: {
				slidesPerView: 2,
			},
			640: {
				slidesPerView: 3,
			},
			992: {
				perView: 4,
			},
			1280: {
				perView: 5,
			},
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});
}

function initImagesGlideSlider() {
	const images = document.querySelectorAll('.images .image');
	if (images.length > 0) {
		const slider = new Glide('.glide', {
			type: 'slider',
			perView: 5,
			gap: 16,
			bound: true,
			breakpoints: {
				1280: {
					perView: 4,
				},
				992: {
					perView: 3,
				},
				640: {
					perView: 2,
				},
				460: {
					perView: 1,
				},
			}
		}).mount();
	}
}

function initTheme() {
	const themeProperties = JSON.parse(document.getElementById('themeProperties').value);
	const themeBackground = document.getElementById('themeBackground').value;

	if (themeProperties) {
		for (const [key, value] of Object.entries(themeProperties)) {
			document.documentElement.style.setProperty(value.slug, value.value);
		}
	}

	if (themeBackground) {
		document.querySelector('.wrapper').style.backgroundImage = `url('${themeBackground}')`;
	}
}

function initCallbackForms() {
	const url = document.getElementById('url').value;
	const subdomain = document.getElementById('subdomain').value;
	const callbackPlaceholders = document.querySelectorAll('p[id|="callbackform"]');

	callbackPlaceholders.forEach(placeholderEl => {
		const placeholderId = placeholderEl.id.split('-')[1];

		placeholderEl.outerHTML =
			`
		<div class="callback-wrapper" id="callback-${placeholderId}">
			<div class="callback-title">
				Остались вопросы? Отправьте нам заявку на бесплатный звонок!
			</div>
			<form class="callback-form">
				<input class="callback-form-input" name="name" placeholder="Ваше имя" required>
				<input class="callback-form-input" name="phone" placeholder="Ваш телефон">
				<input class="callback-form-input" type="submit" value="Заказать звонок">
			</form>
		</div>
		`;
		const callbackWrapper = document.querySelector(`.callback-wrapper[id="callback-${placeholderId}"]`);
		const callbackForm = callbackWrapper.querySelector('form');
		const inputPhone = callbackWrapper.querySelector('input[name="phone"]');
		const maskOptions = {
			mask: '+{7}(000)000-00-00',
			lazy: false,
		};
		const mask = IMask(inputPhone, maskOptions);
		callbackForm.addEventListener("submit", (e) => {
			e.preventDefault();
			let form = e.target;
			let formData = new FormData(form);
			let phoneValue = form.querySelector('input[name="phone"]').value.replaceAll("_", "")
				.replaceAll("(", "").replaceAll(")", "").replaceAll("-", "");
			if (phoneValue.length != 12) {
				alert('Заполните телефон');
				return;
			}
			formData.set('phone', phoneValue)
			formData.set('subdomain', subdomain)
			fetch(`${url}/site/callbackForm`, {
				method: "POST",
				body: formData,
			})
				.then((response) => response.json())
				.then((json) => {
					if (json.status == 'success') {
						form.closest('.callback-wrapper').innerHTML =
							`
							<div class="callback-title" style="margin-bottom:0;text-align:center;">
								Мы с вами обязательно свяжемся
							</div>
							`;
					}
				})
				.catch((error) => {
					alert('Произошла непредвиденная ошибка. Повторите позже.');
				});
		});
	});
}

function initSpecialOffers() {
	const specialOffersToggler = document.querySelector('.special_offers_toggler');
	const specialOffersCaption = document.querySelector('.special_offers_caption');
	const SPECIAL_OFFERS_TOGGLER_ICON_OPEN = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">' +
		'<path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"></path>' +
		'</svg>';
	const SPECIAL_OFFERS_TOGGLER_ICON_CLOSE = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">' +
		'<path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"></path>' +
		'</svg>';
	const SPECIAL_OFFERS_TOGGLER_CAPTION_OPEN = "ОТКРЫТЬ СПЕЦПРЕДЛОЖЕНИЯ";
	const SPECIAL_OFFERS_TOGGLER_CAPTION_CLOSE = "ЗАКРЫТЬ СПЕЦПРЕДЛОЖЕНИЯ";

	if (specialOffersToggler && specialOffersToggler) {
		specialOffersToggler.innerHTML = SPECIAL_OFFERS_TOGGLER_ICON_CLOSE;
		specialOffersCaption.innerHTML = SPECIAL_OFFERS_TOGGLER_CAPTION_OPEN;
		specialOffersToggler.addEventListener('click', () => {
			const toggler = specialOffersToggler;
			const caption = specialOffersCaption;
			const collapseBlock = document.querySelector('.special_offers_collapse');

			if (toggler.classList.contains('active')) {
				collapseBlock.classList.remove('show');
				collapseBlock.style.maxHeight = null;
				collapseBlock.style.maxWidth = null;
				toggler.classList.remove('active');
				toggler.innerHTML = SPECIAL_OFFERS_TOGGLER_ICON_CLOSE;
				caption.innerHTML = SPECIAL_OFFERS_TOGGLER_CAPTION_OPEN;
			} else {
				collapseBlock.classList.add('show');
				collapseBlock.style.maxHeight = collapseBlock.scrollHeight + 'px';
				collapseBlock.style.maxWidth = collapseBlock.scrollWidth + 'px';
				toggler.classList.add('active');
				toggler.innerHTML = SPECIAL_OFFERS_TOGGLER_ICON_OPEN;
				caption.innerHTML = SPECIAL_OFFERS_TOGGLER_CAPTION_CLOSE;
			}
		});
	}
}

function initModals() {
	const modalBtns = document.querySelectorAll('.modal_btn');
	const modalWrappers = document.querySelectorAll('.modal_wrapper');

	modalBtns.forEach(btnEl => {
		btnEl.addEventListener('click', () => {
			const selector = btnEl.getAttribute('data-target');
			const modal = document.querySelector(selector);
			openModal(modal);
		});
	});

	modalWrappers.forEach(wrapperEl => {
		wrapperEl.addEventListener('click', (e) => {
			const modal = wrapperEl.querySelector('.modal');
			const closeBtn = wrapperEl.querySelector('.btn_close');
			if (!e.composedPath().includes(modal) || e.composedPath().includes(closeBtn)) {
				closeModal(wrapperEl);
			}
		});
	});
}

function openModal(modal) {
	if (!document.body.classList.contains('modal-open') && !modal.classList.contains('show')) {
		modal.style.display = 'block';
		setTimeout(() => {
			modal.classList.add('show');
		}, 1);
		document.body.classList.add("modal-open");
	}
}

function closeModal(modal) {
	if (modal.classList.contains('show') && document.body.classList.contains('modal-open')) {
		modal.classList.remove('show');
		setTimeout(function () {
			modal.style.display = 'none';
			document.body.classList.remove("modal-open");
		}, TRANSITION_DELAY);
	}
}

