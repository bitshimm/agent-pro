<script type="text/javascript" src="{{ $host }}/js/lazysizes/lazysizes.min.js"></script>

<script src="{{ $host }}/js/fancybox/fancybox.min.js"></script>
<script src="{{ $host }}/js/glide/glide.min.js"></script>
<script src="{{ $host }}/js/swiper/swiper-bundle.min.js"></script>
<script src="{{ $host }}/js/imask/imask.js"></script>
<script src="{{ $host }}/siteStatic/script.js?{{ config('version.hash') }}"></script>
<script>
    const host = @json($host);
    const subdomain = @json($subdomain);
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
            fetch(`${host}/site/callbackForm`, {
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
</script>
