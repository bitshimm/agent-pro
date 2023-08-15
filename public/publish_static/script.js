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
    spaceBetween: 5,
    navigation: {
        nextEl: '.images-button-next',
        prevEl: '.images-button-prev',
    },
    breakpoints: {
        480: {
            slidesPerView: 2,
        },
        640: {
            slidesPerView: 3,
        },
        800: {
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
    const navbarToggles = document.querySelector('.navbar-toggler');

    const transitionDelay = 300;

    navbarToggles.addEventListener('click', () => {
        const collapseBlock = document.querySelector('.navbar-collapse');
        if (collapseBlock.classList.contains('show')) {
            collapseBlock.classList.remove('show');
        } else {
            collapseBlock.classList.add('show');
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
