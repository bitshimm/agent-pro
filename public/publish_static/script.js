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

new Glide('.images_container', {
    type: 'carousel',
    carousel: 'images_wrapper',
    perView: 5,
    breakpoints: {
        1024: {
            perView: 4,
        },
        880: {
            perView: 3,
        },
        640: {
            perView: 2,
        },
        480: {
            perView: 1,
        },
    },
}).mount();

document.addEventListener("DOMContentLoaded", function () {
    const modalBtns = document.querySelectorAll('.modal_btn');
    const modalWrappers = document.querySelectorAll('.modal_wrapper');
    const navbarToggles = document.querySelector('.navbar-toggler');

    navbarToggles.addEventListener('click', () => {
        const collapseBlock = document.querySelector('.navbar-collapse');
        if (collapseBlock.classList.contains('show')) {
            // collapseBlock.classList.remove('collapse');
            // collapseBlock.classList.add('collapsing');
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
            }, 300);
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