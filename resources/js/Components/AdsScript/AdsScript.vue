<script setup>
import {loadScript} from "vue-plugin-load-script";
import {usePage} from '@inertiajs/inertia-vue3';
import {onMounted} from "vue";
import 'aos/dist/aos.css';

const analytics = usePage().props.value.siteConfig.configurations[0].analytics_metric;
const facebookPixel = usePage().props.value.siteConfig.configurations[0].facebookpixel

onMounted(() => {
    setTimeout(() => {
        loadScript("https://unpkg.com/aos@next/dist/aos.js")
            .then(() => {
                AOS.init({
                    duration: 1400,
                    once: true,
                });
            })
            .catch(() => {
                // Failed to fetch script
            });
    }, 2000)

    setTimeout(() => {
        if (analytics) {
            loadScript("https://www.googletagmanager.com/gtag/js?id=" + analytics)
                .then(() => {
                    window.dataLayer = window.dataLayer || [];

                    function gtag() {
                        dataLayer.push(arguments);
                    }

                    gtag('js', new Date());
                    gtag('config', analytics);
                })
                .catch(() => {
                    // Failed to fetch script
                });
        }

        if (facebookPixel) {
            //Meta Pixel Code
            !function (f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function () {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', facebookPixel);
            fbq('track', 'PageView');

            // End Meta Pixel Code
        }

    }, 6000)

    setTimeout(() => {
        const scriptRecaptcha = document.createElement('script')
        scriptRecaptcha.setAttribute('src', 'https://www.google.com/recaptcha/api.js?render=' + import.meta.env.VITE_RECAPTCHA_KEY)
        document.body.appendChild(scriptRecaptcha)

        window.Laravel = {
            csrfToken: document.head.querySelector('meta[name="_token"]'),
            recaptcha_key: document.head.querySelector('meta[name="_key"]')
        }
    }, 4000)
})
</script>

<template></template>
