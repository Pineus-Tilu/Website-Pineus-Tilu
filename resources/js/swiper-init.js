document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.mySwiper', {
                slidesPerView: 2, // tampil 2 slide
                spaceBetween: 20,
                loop: true, // loop tanpa batas
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1
                    }, // mobile tampil 1 slide
                    640: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 2
                    },
                },
            });
        });