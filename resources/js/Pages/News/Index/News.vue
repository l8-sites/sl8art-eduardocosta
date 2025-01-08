<script setup>
import * as func from '@/Helpers/functions'
</script>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import App from "@/Pages/App.vue"
import Button from '@/Components/Button/Button.vue'
import Icon from '@/Components/Icon/Icon.vue'
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Pagination, Navigation, Autoplay, Keyboard } from 'swiper';

import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';

export default {
    components: {
        App,
        Button,
        Icon,
        Swiper, SwiperSlide,
        Pagination, Navigation, Autoplay, Keyboard, 
        Link
    },
    props: {
        data: Object,
        emphasis: Object,
    },
    data() {
        return {
            url: window.location.href,
            modules: [Autoplay, Navigation, Keyboard, Pagination],
        }
    },
    methods: {
        goNext() {
            this.$emit('prev');
        },
        goPrev() {
            this.$emit('next');
        },
    }
}
</script>


<template>

    <Head :title="titleNews" />

    <App>
        <section v-if="emphasis" class="home-carnaval bg-primary pt-14 md:pt-[20px] ">
            <div class="md:container max-w-[1040px] container-carnaval flex items-center relative">

                <swiper ref="swiper" :effect="'fade'" :keyboard="true" :slidesPerView="1" :spaceBetween="30"
                    :centeredSlides="true" :allowTouchMove="true" :grabCursor="true"
                    :navigation="{ nextEl: '.custom-next-button', prevEl: '.custom-prev-button' }" :pagination="false"
                    :modules="modules" class="swiper-nav swiper-carnaval mb-6 md:mb-[60px] md:pt-[40px] px-8">

                    <swiper-slide v-for="(item, index) in emphasis" :key="index" class="swiper-carnaval-slide ">

                        <a :href="route('noticia', item.url)"
                            class="md:grid md:grid-cols-7 gap-1 md:gap-8  md:px-[50px]">

                        <div @click="showMultiple(index)" :style="{ 'background': 'url(' + item.image_cdn + ')' }"
                            class="aspect-[4/3] object-cover relative cursor-pointer bg-top col-span-4 c-news__image "
                            style="background-repeat: no-repeat; background-size: cover; background-position: center;">
                        </div>

                        <div class="flex flex-col justify-center md:col-span-3  ">
                            <!--                                <p class="text-white">{{item}}</p>-->
                            <!--                                <p class="text-white italic font-semibold text-sm mb-2 text-center md:text-left uppercase">
                                    CARNAVAL {{ item.name }}
                                </p>-->

                            <h3
                                class="text-white font-bold text-lg md:text-3xl text-center mt-8 md:mt-0 md:text-left md:mb-2 uppercase min-h-[84px] flex items-center">
                                {{ item.title }}</h3>

                            <!--                                <div class="text-white text-sm max-h-[140px] overflow-hidden hidden md:block">
                                                                    {{ item.subtitle }}
                                                                </div>-->

                            <div class="w-full flex items-center justify-center mb-7 pt-4">


                                <Button type="a" :href="route('noticia', item.url)" color="outline-light"
                                    class="tracking-widest w-full md:w-[12.25rem] rounded" size="lg">
                                    Saiba mais
                                </Button>

                            </div>

                        </div>

                        </a>

                    </swiper-slide>


                </swiper>


                <div class="swipper-navigation hidden md:block">
                    <div class="md:px-4 flex justify-between">
                        <button type="button" class="swiper-nav-button custom-prev-button" @click="goPrev">
                            <Icon name="icon-nav"
                                class="w-9 h-9 fill-white scale-[-1] " />
                        </button>

                        <button type="button" class="swiper-nav-button custom-next-button" @click="goNext">
                            <Icon name="icon-nav" class="w-9 h-9 fill-white" />
                        </button>
                    </div>
                </div>

            </div>
        </section>

        <section class="pt-14 pb-8 md:pt-16">
            <div class="container max-w-[960px]">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-4">
                    <div v-for="item in data" :key="item.id" class="md:border border-gray/10 overflow-hidden">
                        <a :href="route('noticia', item.url)" class="w-full">
                        <figure class="c-news__image">
                            <img :src="item.image_cdn" :alt="item.title" class="w-full aspect-[4/3] object-cover object-top"
                                :srcset="[item.image_cdn + ' 320w']" />
                        </figure>

                        <div class="p-3 flex flex-col gap-2 md:gap-1">
                            <span v-if="item.emphasis"
                                class="bg-primary text-sm text-black uppercase font-black py-[6px] mt-2 px-4 italic mx-auto order-1 md:hidden">
                                Exclusivo
                            </span>

                            <span
                                class="text-white font-semibold text-2xl md:text-base text-center md:text-left md:leading-[1.35] uppercase order-2">
                                {{ item.title }}
                            </span>

                            <div class="flex justify-center md:justify-start order-3 md:hidden">
                                <a :href="'https://api.whatsapp.com/send?text=' + url + '/' + item.url_cat + '/' + item.url"
                                    target="_blank" aria-label="Whatsapp"
                                    class="bg-[#25d366] hover:bg-[#20b958] transition ease-in-out duration-300 text-xs text-white font-black py-2 px-6  flex items-center mr-1">
                                    <Icon name="icon-whatsapp" class="h-4 w-4 object-contain fill-white" />
                                </a>

                                <a :href="'https://telegram.me/share/url?url=' + url + '/' + item.url_cat + '/' + item.url"
                                    target="_blank" aria-label="telegram"
                                    class="bg-[#5ea8e3] hover:bg-[#467dab] transition ease-in-out duration-300 text-xs text-white font-black py-2 px-6 flex items-center mr-1">
                                    <Icon name="icon-telegram" class="h-4 w-4 object-contain fill-white" />
                                </a>

                                <a :href="'https://www.facebook.com/sharer/sharer.php?u=' + url + '/' + item.url_cat + '/' + item.url"
                                    target="_blank" aria-label="facebook"
                                    class="bg-[#227bef] hover:bg-[#185ab1] transition ease-in-out duration-300 text-xs text-white font-black py-2 px-6 flex items-center mr-1">
                                    <Icon name="icon-facebook" class="h-4 w-4 object-contain fill-white" />
                                </a>

                                <a :href="'https://twitter.com/intent/tweet?url=' + url + '/' + item.url_cat + '/' + item.url + '&text=' + item.title"
                                    target="_blank" aria-label="twitter"
                                    class="bg-[#202020] hover:bg-[#000000] text-xs text-white font-black md:py-2 px-6 flex items-center">
                                    <Icon name="icon-x" class="h-4 w-4 object-contain fill-white" />
                                </a>
                            </div>

                            <div
                                class="w-full flex items-center justify-center md:justify-start order-4 md:order-1 gap-2">
                                <p v-if="item.exclusive"
                                    class="bg-primary text-xs text-white uppercase font-black py-[3px] px-2 italic hidden md:flex">
                                    Exclusivo
                                </p>

                                <p
                                    class="text-sm text-white/50 text-center md:text-left order-2 md:order-1">
                                    {{ func.dateFormat(item.date, item.date) }}</p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

              
            </div>
        </section>
    </App>

</template>

<style src="./style.scss" lang="scss" scoped />
