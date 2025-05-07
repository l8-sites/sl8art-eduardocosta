<script>
import { send } from "@/Helpers/Api";
import { Swiper, SwiperSlide } from "swiper/vue";
import SwiperCore, { Navigation, EffectFade, Pagination } from "swiper";

import "swiper/css";
import "swiper/css/pagination";
import "swiper/css/navigation";
import "swiper/css/effect-fade";

export default {
    components: {
        Swiper,
        SwiperSlide
    },
    data() {
        return {
            bio: [],
            progressWidth: 0,
            pagination: {
                el: '.swiper-pagination-custom',
                clickable: true,
                renderBullet: function (index, className) {
                    return `<span class="${className} w-6 h-3 bg-transparent relative -left-1 rounded-full block transition-transform "></span>`;
                },
            },
            modules: [Pagination, Navigation,],
        };
    },
    async mounted() {
        const data = await send("history");
        this.bio = data;
    },
    methods: {
        onSlideChange(swiper) {
            const progress = ((swiper.activeIndex + 1) / swiper.slides.length) * 100;
            this.progressWidth = progress;
        },
        nextSlide() {
            this.$refs.timelineSwiper.swiper.slideNext();
        },
        prevSlide() {
            this.$refs.timelineSwiper.swiper.slidePrev();
        }
    }
};
</script>


<template>
    <section id="biography">
        <div class="py-10 lg:py-20 c-biography">
            <swiper
                ref="timelineSwiper"
                :slides-per-view="1"
                :pagination="pagination"
                @slideChange="onSlideChange"
                :modules="modules"
                effect="fade"
                class="mySwiper"
            >
                <swiper-slide v-for="(item, index) in bio" :key="index">
            <div class="container relative grid grid-cols-1 h-[600px] md:h-auto md:gap-12 md:grid-cols-2">
                <img :src="item.image_cdn" alt="Imagem Biografia" class="w-3/4 top-24  md:top-10 relative md:left-32 rounded z-[2] lg:h-full" data-aos="fade-up" data-aos-delay="700">
                <div class="flex flex-col text-lg text-center md:text-right space-y-4">
                    <h2 class="absolute text-[#CF2151] md:-top-4 top-12 z-10 left-[230px] md:left-[500px] text-8xl md:text-9xl font-bold mb-4" data-aos="fade-up" data-aos-delay="400">{{ item.title }}</h2>
                    <h2 class="text-white md:text-right md:relative absolute -top-[0px] md:top-0 text-4xl lg:text-5xl max-w-[450px] font-bold uppercase" data-aos="fade-up" data-aos-delay="400">Biografia</h2>
                    <div class="text-white absolute max-w-[350px]  md:max-w-[450px] md:top-20 leading-8" v-html="item.text" data-aos="fade-up" data-aos-delay="400"></div>
                </div>
                <div class="mt-6">
                </div>
            </div>

                </swiper-slide>
            </swiper>



            <div class="w-full flex items-center gap-6 mt-12 px-8">
                <div class="swiper-pagination-custom absolute z-10 w-[600px] h-4 bottom-28 left-8 md:left-8 2xl:left-[314px] flex gap-2"></div>
                    <div class="relative w-[587px] -top-5 left-0 md:left-0 2xl:left-72 md:-top-10 h-[2px] bg-white" data-aos="fade-up" data-aos-delay="400">
                        <div
                            v-for="(item, index) in bio.length" :key="index" class="absolute top-0 h-4 w-[2px] bg-white"
                            :style="{ left: (index / (bio.length - 1)) * 100 + '%' }">
                        </div>
                        <div
                            class="absolute top-0 h-[2px] bg-[#CF2151] transition-all duration-500"
                            :style="{ width: progressWidth + '%' }"
                        ></div>
                    </div>



                <span class="text-white md:block hidden text-sm uppercase relative -top-16 -left-40 whitespace-nowrap" data-aos="fade-up" data-aos-delay="700">
                        Linha do Tempo
                </span>
            </div>
        </div>
    </section>
</template>


<style src="./style.scss"></style>

