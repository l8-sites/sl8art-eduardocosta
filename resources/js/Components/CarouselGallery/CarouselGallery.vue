<script>

import axios from "axios";

import VueEasyLightbox from 'vue-easy-lightbox'
import { ref, reactive } from "vue";
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Pagination, Navigation, Autoplay, Keyboard } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import Icon from "@/Components/Icon/Icon.vue";


export default {

    components: {
        Swiper,
        SwiperSlide,
        VueEasyLightbox,
        Icon
    },
    props: {
        gallery: Object
    },
    data() {
        return {
            modules: [Autoplay, Navigation, Keyboard, Pagination],
            indexAgenda: null,
            breakpoints: {
                '640': {
                    slidesPerView: 1,
                    spaceBetween: 5,
                    centeredSlides: false,

                },
                '768': {
                    slidesPerView: 2,
                    spaceBetween: 5,
                    centeredSlides: false,

                },
                '1024': {
                    slidesPerView: 3,
                    spaceBetween: 5,
                    centeredSlides: false,

                },
                '1366': {
                    slidesPerView: 4,
                    spaceBetween: 5,
                    centeredSlides: false,
                },
                '1600': {
                    slidesPerView: 5,
                    spaceBetween: 5,
                    centeredSlides: false,
                },
            }
        }
    },
    methods: {
        showNav(tam) {
            if (tam >= 2 && window.innerWidth >= 760) {
                return true;
            } else {
                return false;
            }

        },

        next() {
            this.$refs.carouselGal.next()
        },
        prev() {
            this.$refs.carouselGal.prev()
        },
        dateFormat(n) {
            const dateObj = new Date(n * 1000);
            const dia = dateObj.getDate()
            const mes = dateObj.getMonth() + 1
            return dia.toString().padStart(2, '0') + " | " + mes.toString().padStart(2, '0')
        },

        goNext() {
            this.$emit('prev');
        },
        goPrev() {
            this.$emit('next');
        },

    },
    setup() {
        const visibleRef = ref(false)
        const indexRef = ref(0) // default 0
        const imgsRef = ref([])
        const albumRef = ref([])

        const onShow = () => {
            visibleRef.value = true
        }

        const showMultiple = (id) => {
            (async () => {
                const response = await axios.get("https://api.flickr.com/services/rest/?&method=flickr.photosets.getPhotos&api_key=2f0e634b471fdb47446abcb9c5afebdc&photoset_id=" + id + "&extras=description,views,url_o,url_sq,url_t,url_q,url_s,url_m,url_l,url_z,url_b,url_h,url_k&format=json&nojsoncallback=1");
                let imgUrl = []

                for (var i = 0; i < response.data.photoset.photo.length; i++) {
                    imgUrl.push(response.data.photoset.photo[i].url_l)
                }

                imgsRef.value = imgUrl

                indexRef.value = 0

                onShow()
            })()
        }

        const onHide = () => (visibleRef.value = false)

        return {
            visibleRef,
            indexRef,
            imgsRef,
            albumRef,
            showMultiple,
            onHide,

        }
    },

}

</script>

<template>

    <vue-easy-lightbox :visible="visibleRef" :imgs="imgsRef" :index="indexRef" @hide="onHide" :maskClosable="false">
    </vue-easy-lightbox>

    <swiper ref="swiper" :effect="'fade'" :keyboard="true" :slidesPerView="1" :spaceBetween="0" :preventClicks="true"
            :allowTouchMove="true" :grabCursor="true" :centeredSlides="false" :loop="false"
            :navigation="{ nextEl: '.button-next-gallery', prevEl: '.button-prev-gallery' }" :breakpoints="breakpoints"
            :modules="modules" v-if="gallery?.length > 5" class="carousel-gallery ">
        <swiper-slide v-for="(item, index) in gallery" :key="index" class="carousel-gallery__item ">

            <button type="button" @click="showMultiple(item.id)" class="w-full h-full ">

                <div class="relative flex flex-col md:left-0 left-8 mb-10 md:mb-0 md:justify-end w-full h-full ">
                    <picture>
                        <source media="(max-width: 699px)" :srcset="item.primary_photo_extras?.url_m" />
                        <img v-if="item.primary_photo_extras?.url_z" :src="item.primary_photo_extras.url_z"
                             :alt="item.title" class="object-cover w-80 h-80 aspect-[5/4] md:h-80 md:w-80 rounded-xl" />
                        <div class="absolute -bottom-2 md:right-1 right-14 bg-secondary text-white p-3 rounded">
                            <h3 class="text-lg font-semibold">{{ item.title._content }}</h3>
                        </div>
                    </picture>

                </div>

            </button>

        </swiper-slide>

        <!-- <div class="swipper-navigation w-full max-w-[1180px] mx-auto px-6 md:mt-4">
            <div class="relative flex justify-center gap-20">
                <button type="button" class="swiper-nav-button custom-prev-button" @click="goPrev">
                    <Icon name="icon-nav" class="h-11 stroke-black fill-white scale-x-[-1]" />
                </button>

                <button type="button" class="swiper-nav-button custom-next-button" @click="goNext">
                    <Icon name="icon-nav" class="h-11 stroke-black fill-white" />
                </button>
            </div>
        </div> -->


    </swiper>

    <div class="container">
        <div class=" swipper-navigation mt-12">
            <div class="container flex justify-between">
                <button type="button" class="swiper-nav-button button-prev-gallery bottom-7 " @click="goPrev">
                    << anterior </button>

                <button type="button" class="swiper-nav-button button-next-gallery bottom-7" @click="goNext">

                    próxima >>
                </button>
            </div>
        </div>
    </div>


</template>

<style src="./style.scss" lang="scss" scoped />
<style>
.carousel__prev,
.carousel__next {
    background-color: transparent !important;
}

.carousel__prev {
    top: initial !important;
    bottom: -45px;
    left: calc(50% - 2rem) !important;
    transform: translate(calc(-50% - 2rem), 0) !important;
}

.carousel__next {
    top: initial !important;
    bottom: -45px;
    right: calc(50% - 2rem) !important;
    transform: translate(calc(-50% - 2rem), 0) !important;
}

.carousel__icon {
    fill: transparent !important;
}

/*
    @media (min-width: 768px) {
        .carousel__prev,
        .carousel__next {
            display: none;
        }
    }
    */


:root {
    --vc-icn-width: 4em;
    --vc-nav-width: 50px;
}
</style>
