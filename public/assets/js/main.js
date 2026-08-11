/*-----------------------------------------------------------------

Template Name: Extech - IT Solution & Technology HTML Template<
Author:  ex-coders
Author URI: https://themeforest.net/user/ex-coders
Developer: Masirul Islam
Version: 1.0.0
Description: Extech - IT Solution & Technology HTML Template<

-------------------------------------------------------------------
Js TABLE OF CONTENTS
-------------------------------------------------------------------

01. header
02. animated text with swiper slider
03. magnificPopup
04. counter up 
05. wow animation
06. nice select
07. swiper slider
08. team hover effect
09. search popup
10. mouse cursor
11. Set Background Image
12. Global Slider
13. Progress Bar Animation 
14. Checkbox
15. preloader

------------------------------------------------------------------*/

// Soft stub before any plugin init: Extech uses Swiper, not Owl Carousel.
(function (jq) {
    if (!jq || typeof jq.fn !== "object") {
        return;
    }
    if (typeof jq.fn.owlCarousel !== "function") {
        jq.fn.owlCarousel = function () {
            return this;
        };
    }
})(window.jQuery || window.$);

(function ($) {
    "use strict";

    if (typeof $.fn.owlCarousel !== "function") {
        $.fn.owlCarousel = function () {
            return this;
        };
    }

    function initSwiper(selector, options) {
        if (!document.querySelector(selector)) {
            return null;
        }

        try {
            return new Swiper(selector, options);
        } catch (error) {
            console.warn("Swiper init skipped for", selector, error);
            return null;
        }
    }

    $(document).ready(function () {

        //>> Mobile Menu Js Start <<//
        if ($.fn.meanmenu && $('#mobile-menu').length) {
            $('#mobile-menu').meanmenu({
                meanMenuContainer: '.mobile-menu',
                meanScreenWidth: "991",
                meanExpand: ['<i class="far fa-plus"></i>'],
            });
        }

        //>> Sidebar Toggle Js Start <<//
        $(document).on("click", ".offcanvas__close, .offcanvas__close button, .offcanvas__overlay", function (e) {
            e.preventDefault();
            $(".offcanvas__info").removeClass("info-open");
            $(".offcanvas__overlay").removeClass("overlay-open");
            $("body").removeClass("overflow-hidden");
        });
        $(document).on("click", ".sidebar__toggle, .header__hamburger", function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(".offcanvas__info").addClass("info-open");
            $(".offcanvas__overlay").addClass("overlay-open");
            $("body").addClass("overflow-hidden");
        });

        //>> Body Overlay Js Start <<//
        $(".body-overlay").on("click", function () {
            $(".offcanvas__area").removeClass("offcanvas-opened");
            $(".df-search-area").removeClass("opened");;
            $(".body-overlay").removeClass("opened");
        });

        //>> Sticky Header Js Start <<//

        $(window).scroll(function () {
            if ($(this).scrollTop() > 250) {
                $("#header-sticky").addClass("sticky");
            } else {
                $("#header-sticky").removeClass("sticky");
            }
        });

        //>> Hero-1 Slider Start <<//
        const sliderActive2 = ".hero-slider";
        const sliderInit2 = initSwiper(sliderActive2, {
            loop: true,
            slidesPerView: 1,
            effect: "fade",
            speed: 3000,
            autoplay: {
                delay: 7000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
        });

        function animated_swiper(selector, init) {
            if (!init) {
                return;
            }
            const animated = function animated() {
                $(selector + " [data-animation]").each(function () {
                    let anim = $(this).data("animation");
                    let delay = $(this).data("delay");
                    let duration = $(this).data("duration");
                    $(this)
                        .removeClass("anim" + anim)
                        .addClass(anim + " animated")
                        .css({
                            webkitAnimationDelay: delay,
                            animationDelay: delay,
                            webkitAnimationDuration: duration,
                            animationDuration: duration,
                        })
                        .one("animationend", function () {
                            $(this).removeClass(anim + " animated");
                        });
                });
            };
            animated();
            init.on("slideChange", function () {
                $(sliderActive2 + " [data-animation]").removeClass("animated");
            });
            init.on("slideChange", animated);
        }
        animated_swiper(sliderActive2, sliderInit2);
        //>> Banner Animation <<//




        //>> Magnific Popup <<//   
        /* magnificPopup img view */
        if ($.fn.magnificPopup) {
            $(".popup-image").magnificPopup({
                type: "image",
                mainClass: 'mfp-zoom-in',
                removalDelay: 260,
                gallery: {
                    enabled: true,
                },
            });



            /* magnificPopup video view */
            $(".popup-video").magnificPopup({
                type: "iframe",
                removalDelay: 260,
                mainClass: 'mfp-zoom-in',
            });



            /* magnificPopup video view */
            $(".popup-content").magnificPopup({
                type: "inline",
                midClick: true,
            });



            //>> Video Popup Start <<//
            $(".img-popup").magnificPopup({
                type: "image",
                gallery: {
                    enabled: true,
                },
            });
        }



        //>> Counter Up  <<//    
        if ($.fn.counterUp && $(".counter-number").length) {
            $(".counter-number").counterUp({
                delay: 10,
                time: 1000,
            });
        }



        //>> Wow Animation Start <<//
        if (typeof WOW !== "undefined") {
            new WOW().init();
        }



        //>> Nice Select Start <<//
        if ($.fn.niceSelect && $('select').length) {
            $('select').niceSelect();
        }



        //>> Brand Slider Start <<//
        const brandSlider = initSwiper(".brand-slider", {
            spaceBetween: 30,
            speed: 1300,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },

            breakpoints: {
                1199: {
                    slidesPerView: 5,
                },
                991: {
                    slidesPerView: 4,
                },
                767: {
                    slidesPerView: 3,
                },
                575: {
                    slidesPerView: 2,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });

        const brandSlider2 = initSwiper(".brand-slider-2", {
            spaceBetween: 30,
            speed: 1300,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },

            breakpoints: {
                1199: {
                    slidesPerView: 5,
                },
                991: {
                    slidesPerView: 4,
                },
                767: {
                    slidesPerView: 3,
                },
                575: {
                    slidesPerView: 2,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });



        //>> Service Slider Start <<// 
        const serviceSlider2 = initSwiper(".service-slider-2", {
            spaceBetween: 30,
            speed: 1500,
            loop: true,
            autoplay: {
                delay: 1500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".dot-2",
                clickable: true,
            },

            breakpoints: {
                1199: {
                    slidesPerView: 4,
                },
                991: {
                    slidesPerView: 2,
                },
                767: {
                    slidesPerView: 2,
                },
                575: {
                    slidesPerView: 2,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });



        //>> Project Slider Start <<// 
        const projectSlider2 = initSwiper(".project-slider-2", {
            spaceBetween: 30,
            speed: 1500,
            loop: true,
            autoplay: {
                delay: 1500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".dot-2",
                clickable: true,
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
            breakpoints: {
                1199: {
                    slidesPerView: 3,
                },
                991: {
                    slidesPerView: 2,
                },
                767: {
                    slidesPerView: 2,
                },

                575: {
                    slidesPerView: 1,
                },

                0: {
                    slidesPerView: 1,
                },
            },
        });

        const projectSlider3 = initSwiper(".project-slider-3", {
            spaceBetween: 30,
            speed: 1500,
            loop: true,
            autoplay: {
                delay: 1500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".dot-2",
                clickable: true,
            },
            breakpoints: {
                1199: {
                    slidesPerView: 4,
                },
                991: {
                    slidesPerView: 2,
                },
                767: {
                    slidesPerView: 2,
                },
                650: {
                    slidesPerView: 2,
                },

                575: {
                    slidesPerView: 1,
                },

                0: {
                    slidesPerView: 1,
                },
            },
        });



        //>> Testimonial Slider Start <<// 

        const testimonialSlider2 = initSwiper(".testimonial-slider-2", {
            speed: 1500,
            loop: true,
            spaceBetween: 30,
            autoplay: {
                delay: 1500,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
            breakpoints: {
                991: {
                    slidesPerView: 2,
                },
                767: {
                    slidesPerView: 1,
                },

                575: {
                    slidesPerView: 1,
                },

                0: {
                    slidesPerView: 1,
                },
            },

        });



        //>> News Slider Start <<//
        const newsSlider = initSwiper(".news-slider", {
            spaceBetween: 30,
            speed: 1500,
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".array-prev",
                prevEl: ".array-next",
            },
            breakpoints: {
                1199: {
                    slidesPerView: 3,
                },
                991: {
                    slidesPerView: 2,
                },
                767: {
                    slidesPerView: 2,
                },

                575: {
                    slidesPerView: 1,
                },

                0: {
                    slidesPerView: 1,
                },
            },
        });



        //>> Team Slider Start <<//
        const teamSlider = initSwiper(".team-slider", {
            spaceBetween: 30,
            speed: 1500,
            loop: true,
            autoplay: {
                delay: 1500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".dot-2",
                clickable: true,
            },

            breakpoints: {
                1199: {
                    slidesPerView: 4,
                },
                991: {
                    slidesPerView: 2,
                },
                767: {
                    slidesPerView: 2,
                },
                575: {
                    slidesPerView: 2,
                },
                0: {
                    slidesPerView: 1,
                },
            },
        });



        //>> Team Hover Image Show Slider Start <<//
        const teamItems = document.querySelectorAll(".team-items");

        function followImageCursor(event, teamItems) {
            const contentBox = teamItems.getBoundingClientRect();
            const dx = event.clientX - contentBox.x;
            const dy = event.clientY - contentBox.y;
            teamItems.children[2].style.transform = `translate(${dx}px, ${dy}px) rotate(0)`;
        }

        teamItems.forEach((item, i) => {
            item.addEventListener("mousemove", (event) => {
                setInterval(followImageCursor(event, item), 1000);
            });
        });


        //>> Search Popup Start <<//
        const $searchWrap = $(".search-wrap");
        const $navSearch = $(".nav-search");
        const $searchClose = $("#search-close");

        $(document).on("click", ".search-trigger", function (e) {
            e.preventDefault();
            e.stopPropagation();
            $searchWrap.stop(true, true).fadeIn(300);
            $navSearch.add($searchClose).addClass("open");
        });

        $(document).on("click", ".search-close, #search-close", function (e) {
            e.preventDefault();
            e.stopPropagation();
            $searchWrap.stop(true, true).fadeOut(200);
            $navSearch.add($searchClose).removeClass("open");
        });

        $(document.body).on("click", function () {
            if ($searchWrap.is(":visible")) {
                $searchWrap.stop(true, true).fadeOut(200);
                $navSearch.add($searchClose).removeClass("open");
            }
        });

        $(document).on("click", ".search-wrap, .main-search-input", function (e) {
            e.stopPropagation();
        });

        //>> Mouse Cursor Start <<//
        function mousecursor() {
            if ($("body")) {
                const e = document.querySelector(".cursor-inner"),
                    t = document.querySelector(".cursor-outer");
                let n,
                    i = 0,
                    o = !1;
                (window.onmousemove = function (s) {
                    o ||
                        (t.style.transform =
                            "translate(" + s.clientX + "px, " + s.clientY + "px)"),
                        (e.style.transform =
                            "translate(" + s.clientX + "px, " + s.clientY + "px)"),
                        (n = s.clientY),
                        (i = s.clientX);
                }),
                    $("body").on("mouseenter", "a, .cursor-pointer", function () {
                        e.classList.add("cursor-hover"), t.classList.add("cursor-hover");
                    }),
                    $("body").on("mouseleave", "a, .cursor-pointer", function () {
                        ($(this).is("a") && $(this).closest(".cursor-pointer").length) ||
                            (e.classList.remove("cursor-hover"),
                                t.classList.remove("cursor-hover"));
                    }),
                    (e.style.visibility = "visible"),
                    (t.style.visibility = "visible");
            }
        }
        $(function () {
            mousecursor();
        });



        //>> Set Background Image  & Mask<<// 
        if ($("[data-bg-src]").length > 0) {
            $("[data-bg-src]").each(function () {
                var src = $(this).attr("data-bg-src");
                $(this).css("background-image", "url(" + src + ")");
                $(this).removeAttr("data-bg-src").addClass("background-image");
            });
        }

        if ($('[data-mask-src]').length > 0) {
            $('[data-mask-src]').each(function () {
                var mask = $(this).attr('data-mask-src');
                $(this).css({
                    'mask-image': 'url(' + mask + ')',
                    '-webkit-mask-image': 'url(' + mask + ')'
                });
                $(this).addClass('bg-mask');
                $(this).removeAttr('data-mask-src');
            });
        };


        //>> Global Slider<<//  
        $('.gt-slider').each(function () {
            var gtSlider = $(this);
            var settings = $(this).data('slider-options') || {};

            // Store references to the navigation Slider
            var prevArrow = gtSlider.find('.slider-prev');
            var nextArrow = gtSlider.find('.slider-next');
            var paginationEl = gtSlider.find('.slider-pagination');
            var paginationElN = gtSlider.find('.slider-pagination.pagi-number');

            var paginationType = settings['paginationType'] ? settings['paginationType'] : 'bullets';

            var autoplayconditon = settings['autoplay'];

            var sliderDefault = {
                slidesPerView: 1,
                spaceBetween: settings['spaceBetween'] ? settings['spaceBetween'] : 24,
                loop: settings['loop'] == false ? false : true,
                speed: settings['speed'] ? settings['speed'] : 1000,
                initialSlide: settings['initialSlide'] ? settings['initialSlide'] : 0,  // Default to 0 if not set
                centeredSlides: settings['centeredSlides'] == true ? true : false,
                autoplay: autoplayconditon ? autoplayconditon : { delay: 6000, disableOnInteraction: false },
                navigation: {
                    nextEl: nextArrow.get(0),
                    prevEl: prevArrow.get(0),
                },
                pagination: {
                    el: paginationEl.get(0),
                    type: paginationType,
                    clickable: true,
                    renderBullet: function (index, className) {
                        var number = index + 1;
                        var formattedNumber = number < 10 ? '0' + number : number;
                        if (paginationElN.length) {
                            return '<span class="' + className + ' number">' + formattedNumber + '</span>';
                        } else {
                            return '<span class="' + className + '" aria-label="Go to Slide ' + formattedNumber + '"></span>';
                        }
                    },
                },
                on: {
                    slideChange: function () {
                        setTimeout(function () {
                            swiper.params.mousewheel.releaseOnEdges = false;
                        }, 500);
                    },
                    reachEnd: function () {
                        setTimeout(function () {
                            swiper.params.mousewheel.releaseOnEdges = true;
                        }, 750);
                    }
                }
            };

            var options = $.extend({}, sliderDefault, settings);
            var swiper = new Swiper(gtSlider.get(0), options); // Assign the swiper variable

            if ($('.slider-area').length > 0) {
                $('.slider-area').closest(".container").parent().addClass("arrow-wrap");
            }

        });

        // Function to add animation classes
        function animationProperties() {
            $('[data-ani]').each(function () {
                var animationName = $(this).data('ani');
                $(this).addClass(animationName);
            });

            $('[data-ani-delay]').each(function () {
                var delayTime = $(this).data('ani-delay');
                $(this).css('animation-delay', delayTime);
            });
        }
        animationProperties();

        // Add click event handlers for external slider arrows based on data attributes
        $('[data-slider-prev], [data-slider-next]').on('click', function () {
            var sliderSelector = $(this).data('slider-prev') || $(this).data('slider-next');
            var targetSlider = $(sliderSelector);

            if (targetSlider.length) {
                var swiper = targetSlider[0].swiper;

                if (swiper) {
                    if ($(this).data('slider-prev')) {
                        swiper.slidePrev();
                    } else {
                        swiper.slideNext();
                    }
                }
            }
        });


        //>> Progress Bar Animation  <<//     
        $('.progress-bar').each(function () {
            var $this = $(this);
            var styleAttr = $this.attr('style') || '';
            var match = styleAttr.match(/width:\s*(\d+)%/);
            if (!match) {
                return;
            }
            var progressWidth = match[1] + '%';

            $this.waypoint(function () {
                $this.css({
                    '--progress-width': progressWidth,
                    'animation': 'animate-positive 1.8s forwards',
                    'opacity': '1'
                });
            }, { offset: '75%' });
        });


        //>> Newsletter subscribe (AJAX + DB + SweetAlert) <<//
        const newsletterForm = $('#newsletterForm');

        if (newsletterForm.length) {
            const checkbox = newsletterForm.find('#agreeCheckbox');
            const submitButton = newsletterForm.find('#submitButton');
            const emailInput = newsletterForm.find('#email, #newsletterEmail').first();
            const csrfToken = $('meta[name="csrf-token"]').attr('content')
                || newsletterForm.find('input[name="_token"]').val();

            const notifyNewsletter = function (type, title, text) {
                if (typeof Swal !== 'undefined' && Swal.fire) {
                    Swal.fire({
                        icon: type,
                        title: title,
                        text: text,
                        confirmButtonColor: type === 'success' ? '#3C72FC' : '#d33'
                    });
                    return;
                }

                window.alert(text);
            };

            const setNewsletterLoading = function (loading) {
                submitButton.data('loading', loading);
                submitButton.prop('disabled', loading === true);
            };

            newsletterForm.on('submit', function (e) {
                e.preventDefault();

                const email = $.trim(emailInput.val() || '');

                if (!email) {
                    notifyNewsletter('error', 'Email required', 'Please enter your email address.');
                    emailInput.trigger('focus');
                    return;
                }

                if (!checkbox.is(':checked')) {
                    notifyNewsletter('error', 'Agreement required', 'Please agree to the Privacy Policy before subscribing.');
                    return;
                }

                setNewsletterLoading(true);

                $.ajax({
                    url: newsletterForm.attr('action'),
                    method: 'POST',
                    data: newsletterForm.serialize(),
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (response) {
                        notifyNewsletter(
                            'success',
                            'Subscribed!',
                            (response && response.message) ? response.message : 'You have successfully subscribed to our newsletter.'
                        );
                        emailInput.val('');
                        checkbox.prop('checked', false);
                    },
                    error: function (xhr) {
                        let errorMessage = 'Unable to subscribe right now. Please try again.';
                        const json = xhr.responseJSON || null;

                        if (json && json.message) {
                            errorMessage = json.message;
                        } else if (json && json.errors) {
                            const firstKey = Object.keys(json.errors)[0];
                            if (firstKey && json.errors[firstKey] && json.errors[firstKey][0]) {
                                errorMessage = json.errors[firstKey][0];
                            }
                        } else if (xhr.status === 419) {
                            errorMessage = 'Session expired. Please refresh the page and try again.';
                        }

                        notifyNewsletter('error', 'Subscription failed', errorMessage);
                    },
                    complete: function () {
                        setNewsletterLoading(false);
                    }
                });
            });
        }


    }); // End Document Ready Function

    function loader() {
        $(window).on('load', function () {
            // Animate loader off screen
            $(".preloader").addClass('loaded');
            $(".preloader").delay(600).fadeOut();
        });
    }

    loader();


})(jQuery); // End jQuery

