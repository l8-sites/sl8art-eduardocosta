<script setup>
import * as func from '@/Helpers/functions'
</script>
<script>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Pagination, Navigation, Autoplay, Keyboard } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import { Link, usePage, Head } from '@inertiajs/inertia-vue3';
import App from "@/Pages/App.vue";
import Button from '@/Components/Button/Button.vue'
import Icon from '@/Components/Icon/Icon.vue'
import CardSchedule from '@/Components/CardSchedule/CardSchedule.vue'



export default {
    components: {
        App,
        Button,
        Icon,
        Link,
        Head,
        CardSchedule,
        Swiper,
        SwiperSlide,

    },
    props: {
        schedule: Object,
        next_schedule: Object
    },
    /*  setup() {
          return {
  
          };
      },*/
    data() {
        return {
            url: window.location.href,
            urlFa: usePage().props.value.siteConfig.centralfa,
            modules: [Navigation, Pagination, Keyboard],
            breakpoints: {
                '640': {
                    slidesPerView: 2,
                    spaceBetween: 10,
                    centeredSlides: true,
                },
                '768': {
                    slidesPerView: 2,
                    spaceBetween: 20,
                    centeredSlides: false,
                },
                '1024': {
                    slidesPerView: 3,
                    spaceBetween: 20,
                    centeredSlides: false,
                },
                '1280': {
                    slidesPerView: 4,
                    spaceBetween: 20,
                    centeredSlides: false,
                },
                '1536': {
                    slidesPerView: 4,
                    spaceBetween: 20,
                    centeredSlides: false,
                },


            },

            bgDesktop2: '',
            bgMobile2: '',

            bgCarouselImpar: '',
            bgCarouselPar: '',
        }
    },
    methods: {
        goNext() {

            this.$emit('prev');
        },
        goPrev() {

            this.$emit('next');
        },
        alternaImagem(id) {
            this.indexAgenda = id;
            let mode = id % 2 + 1;
            return this.$asset + '/images/img' + mode + '.webp';
        },
    },
}
</script>

<template>
    <App>
        <section class="pb-10 pt-14 md:pt-16 bg-black">


            <div class="container relative  z-[1]">
                <h1 class="o-title text-center mb-8">
                    <span class="hidden text-[0]">{{ schedule.city_name }} - {{ schedule.state_uf }} |</span>
                    {{
                        new Date(schedule.date).toLocaleDateString('pt-BR', {
                            day: 'numeric', month: 'long', timeZone: 'UTC'
                        })
                    }}
                </h1>

                <h2
                    class="text-base md:text-xl text-white font-light uppercase tracking-wider text-center mb-8 md:mb-4 font-secondary">
                    detalhes do show
                </h2>

                <div class="flex flex-col md:flex-row mb-4 md:mb-8">

                    <div class="w-full md:w-6/12 px-0 md:px-4 md:border-r border-white mb-6 md:mb-0">
                        <ul class="c-list c-list--right">
                            <li class="c-list__item">
                                País <br>
                                <span>{{ schedule.country_name }}</span>
                            </li>

                            <li class="c-list__item">
                                Estado <br>
                                <span>{{ schedule.state_name }}</span>
                            </li>

                            <li class="c-list__item">
                                Local <br>
                                <span>{{ schedule.local }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="w-full md:w-6/12 px-0 md:px-4">
                        <ul class="c-list c-list--right@md">
                            <li class="c-list__item">
                                Cidade <br>
                                <span>{{ schedule.city_name }}</span>
                            </li>

                            <li class="c-list__item">
                                Evento <br>
                                <span>{{ schedule.name }}</span>
                            </li>

                            <!-- <li v-if="schedule.show_time_site" class="c-list__item"> -->
                            <li v-if="schedule.show_time_site" class="c-list__item">
                                horário <br>
                                <span>{{ func.hourFormat(schedule.time) }}H</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center justify-center mb-8 gap-4">
                    <Button v-if="schedule.link_sale" type="a" :href="schedule.link_sale" target="_blank"
                        color="tertiary" class="w-full md:w-max">Comprar Ingresso
                    </Button>
                    <!-- <span class="text-white">{{ urlFa }}</span> -->
                    <Button v-if="schedule.prize_draw && urlFa" type="a" :href="urlFa" target="_blank" color="tertiary"
                        class="w-full md:w-max">Participar do Camarim
                    </Button>
                </div>

                <div
                    class="flex flex-col md:flex-row bg-tertiary w-max mx-auto px-8 py-3 items-center justify-center gap-4 md:mb-8 rounded-lg">


                        <Icon name="icon-share" class="w-6 h-6 fill-secondary hidden md:block" />
                        <h3 class="font-medium text-white uppercase  mb-1 md:mb-0 font-secondary ">
                            compartilhe 
                        </h3>
                    

                    <ul class="flex gap-4">
                        <li>
                            <a :href="'https://www.facebook.com/sharer/sharer.php?u=' + url + '!'" target="_blank"
                                class="hover:opacity-60">
                                <Icon name="icon-facebook-round" class="w-8 h-8 fill-white" />
                            </a>
                        </li>

                        <li>
                            <a :href="'https://twitter.com/intent/tweet?text=' + schedule.city_name + ' - ' + schedule.state_uf + ' contará com a presença de ' + $title + ' dia ' + new Date(schedule.date).toLocaleDateString('pt-BR', { day: 'numeric', month: 'long' }) + '! ' + url"
                                target="_blank" class="hover:opacity-60">
                                <Icon name="icon-x-round" class="w-8 h-8 fill-white" />
                            </a>
                        </li>

                        <li>
                            <a :href="'https://api.whatsapp.com/send?text=' + schedule.city_name + ' - ' + schedule.state_uf + ' contará com a presença de ' + $title + ' dia ' + new Date(schedule.date).toLocaleDateString('pt-BR', { day: 'numeric', month: 'long' }) + '! ' + url"
                                target="_blank" class="hover:opacity-60">
                                <Icon name="icon-whatsapp-round" class="w-8 h-8 fill-white" />
                            </a>
                        </li>
                    </ul>
                </div>

                <div v-if="false" class="w-full md:w-6/12 mx-auto mb-6 hidden">
                    <h3 class="font-medium text-white uppercase mr-2">Como Chegar</h3>
                </div>
            </div>
        </section>

        <section class="bg-black pt-4 pb-10 md:pb-6 ">
            <div class="container flex items-center justify-between mb-5 ">
                <h2 class="o-title text-white font-normal text-lg md:text-xl w-full tracking-[.095em] text-left">
                    Próximos <br class="md:hidden">shows
                </h2>

                <Button type="a" :href="route('agendas')" color="outline-light" class="rounded">
                    Ver todos
                </Button>
            </div>



            <aside class="container w-full pt-3 md:pt-6">
                <!--                <pre>{{ next_schedule }}</pre>-->

                <swiper :slides-per-view="1" :space-between="20" :breakpoints="breakpoints" :modules="modules"
                    :navigation="{ nextEl: '.custom-next-button', prevEl: '.custom-prev-button' }" ref="swiper"
                    class="mySwiper">
                    <swiper-slide v-for="(item, index) in next_schedule" :key="index">
                        <a :href="route('agenda', item.url)" class="c-schedule__item">

                            <!-- <div class="bg-carousel-schedule" :style="{background : 'url('+ alternaImagem((index)) + ')'}"></div> -->

                            <div
                                class="h-full flex flex-col items-center  bg-primary rounded-xl gap-4 justify-between relative z-[2] py-6 px-6">
                                <div class="flex flex-col items-center w-full">

                                    <p class="c-schedule__day border-b-2 pb-2">
                                        {{
                        new Date(item.date.split(' ')[0].replace(/-/g,
                            "/")).toLocaleDateString('pt-BR',
                                {
                                    day:
                                        'numeric'
                                })
                    }}
                                    </p>

                                    <p class="c-schedule__month pt-2">
                                        {{
                            new Date(item.date.split(' ')[0].replace(/-/g,
                                "/")).toLocaleDateString('pt-BR',
                                    {
                                        month:
                                            'long'
                                    })
                        }}
                                    </p>

                                </div>

                                <template v-if="!item.corporate">
                                    <div v-if="!item.distrito_age"
                                        class="w-full flex flex-col justify-center items-center gap-1">
                                        <p class="c-schedule__city">
                                            {{ item.city_name }} | {{ item.state_uf }}
                                        </p>

                                    </div>

                                    <div v-else class="flex-1 flex justify-center">
                                        <p class="text-sm font-light text-white uppercase"
                                            :title="item.distrito_age + 'é distrito de ' + item.nome_cid + ' ' + item.uf_est">
                                            {{ item.distrito_age }} | {{ item.uf_est }}
                                        </p>
                                    </div>
                                </template>

                                <div v-else class="w-full flex-1 flex items-center">
                                    <p class="c-schedule__corporate">
                                        Evento Corporativo
                                    </p>
                                </div>

                                <span class="c-schedule__details">+ Mais detalhes</span>
                            </div>
                        </a>
                    </swiper-slide>


                    <div class="swipper-navigation flex">
                        <div class="container flex justify-between">
                            <button type="button" class="swiper-nav-button custom-prev-button" @click="goPrev">
                                <span class="text-primary">
                                    <<< </span> ANTERIOR </button>

                            <button type="button" class="swiper-nav-button custom-next-button" @click="goNext">
                                PRÓXIMO <span class="text-primary">>>></span>
                            </button>
                        </div>
                    </div>

                </swiper>

                <div class="container mt-6">
                    <div class="c-deslize ">
                        <Icon name="icon-indicator" class="c-deslize__indicator 0" />
                        Deslize para navegar
                    </div>
                </div>
            </aside>
        </section>
    </App>
</template>

<style src="./style.scss" lang="scss" scoped />

<style lang="scss" scoped>
/*.bg-schedule-details {
    background: v-bind(bgDesktop2);

    @media (max-width: 768px) {
        background: v-bind(bgMobile2);

    }
}*/

.bg-carousel-schedule {
    background: v-bind(bgCarouselImpar);
}

.swiper-slide {
    height: auto;

    &:nth-child(even) {
        .c-schedule {

            &__item {
                .bg-carousel-schedule {
                    background: v-bind(bgCarouselPar);
                }
            }
        }
    }
}
</style>
