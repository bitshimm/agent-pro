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

const swiper = new Swiper('.swiper', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 16,
    navigation: {
        nextEl: '.images-button-next',
        prevEl: '.images-button-prev',
    },
    breakpoints: {
        460: {
            slidesPerView: 2,
        },
        640: {
            slidesPerView: 3,
        },
        992: {
            slidesPerView: 4,
        },
        1280: {
            slidesPerView: 5,
        }
    }
});


document.addEventListener("DOMContentLoaded", function () {
    const modalBtns = document.querySelectorAll('.modal_btn');
    const modalWrappers = document.querySelectorAll('.modal_wrapper');
    const navbarToggler = document.querySelector('.navbar-toggler');
    const specialOffersToggler = document.querySelector('.special_offers_toggler');
    const specialOffersCaption = document.querySelector('.special_offers_caption');

    const specialOffersTogglerIconOpen = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">' +
        '<path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"></path>' +
        '</svg>';
    const specialOffersTogglerIconClose = '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512">' +
        '<path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"></path>' +
        '</svg>';
    const specialOffersTogglerCaptionClose = "ОТКРЫТЬ СПЕЦПРЕДЛОЖЕНИЯ";
    const specialOffersTogglerCaptionOpen = "ЗАКРЫТЬ СПЕЦПРЕДЛОЖЕНИЯ";
    const transitionDelay = 300;


    /**
     * init Special Offers
     */
    specialOffersToggler.innerHTML = specialOffersTogglerIconClose;
    specialOffersCaption.innerHTML = specialOffersTogglerCaptionClose;


    specialOffersToggler.addEventListener('click', () => {
        const toggler = specialOffersToggler;
        const caption = specialOffersCaption;
        const collapseBlock = document.querySelector('.special_offers_collapse');

        console.log(collapseBlock.scrollWidth);
        if (toggler.classList.contains('active')) {
            collapseBlock.classList.remove('show');
            collapseBlock.style.maxHeight = null;
            collapseBlock.style.maxWidth = null;
            toggler.classList.remove('active');
            toggler.innerHTML = specialOffersTogglerIconClose;
            caption.innerHTML = specialOffersTogglerCaptionClose;
        } else {
            collapseBlock.classList.add('show');
            collapseBlock.style.maxHeight = collapseBlock.scrollHeight + 'px';
            collapseBlock.style.maxWidth = collapseBlock.scrollWidth + 'px';
            toggler.classList.add('active');
            toggler.innerHTML = specialOffersTogglerIconOpen;
            caption.innerHTML = specialOffersTogglerCaptionOpen;
        }
    });
    navbarToggler.addEventListener('click', () => {
        const collapseBlock = document.querySelector('.navbar-collapse');

        if (collapseBlock.classList.contains('show')) {
            collapseBlock.classList.remove('show');
            collapseBlock.style.maxHeight = null;
        } else {
            collapseBlock.classList.add('show');
            collapseBlock.style.maxHeight = collapseBlock.scrollHeight + 'px';
        }
    });

    function openModal(selector) {
        const modal = document.querySelector(selector);

        if (!document.body.classList.contains('modal-open') && !modal.classList.contains('show')) {
            modal.style.display = 'block';
            setTimeout(() => {
                modal.classList.add('show');
            }, 1);
            document.body.classList.add("modal-open");
        }
    }

    function closeModal(selector) {
        const modal = document.querySelector(selector);

        if (modal.classList.contains('show') && document.body.classList.contains('modal-open')) {
            modal.classList.remove('show');
            setTimeout(function () {
                modal.style.display = 'none';
            }, transitionDelay);
            document.body.classList.remove("modal-open");
        }
    }

    modalBtns.forEach(btnEl => {
        btnEl.addEventListener('click', () => {
            const selector = btnEl.getAttribute('data-target');
            openModal(selector);
        });
    });

    modalWrappers.forEach(wrapperEl => {
        wrapperEl.style.transition = `${transitionDelay}ms ease`;
        wrapperEl.querySelector('.modal').style.transition = `${transitionDelay}ms ease`;
        wrapperEl.addEventListener('click', (e) => {
            const modal = wrapperEl.querySelector('.modal');
            const selector = wrapperEl.getAttribute('id');
            const closeBtn = wrapperEl.querySelector('.btn_close');
            if (!e.composedPath().includes(modal) || e.composedPath().includes(closeBtn)) {
                closeModal('#' + selector);
            }
        });
    });
});
