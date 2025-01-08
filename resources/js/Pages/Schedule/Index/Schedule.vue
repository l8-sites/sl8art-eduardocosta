<script>
import { Link, usePage, Head } from '@inertiajs/inertia-vue3';
import App from "@/Pages/App.vue";
import Button from '@/Components/Button/Button.vue'
import Icon from '@/Components/Icon/Icon.vue'

export default {
    components: {
        App,
        Button,
        Icon,
        Link,
        Head
    },
    props: {
        schedules: Object,
    },
    data() {
        return {
            url: window.location.href,
            urlFa: usePage().props.value.siteConfig.centralfa,

            bgDesktop: '',
            bgMobile: '',

            settingsAllSchedule: {
                itemsToShow: 1.5,
                mouseDrag: true,
                touchDrag: true,
                breakpoints: {
                    1400: {
                        mouseDrag: false,
                        touchDrag: false,
                        itemsToShow: 4,
                    },
                    1024: {
                        mouseDrag: true,
                        touchDrag: true,
                        itemsToShow: 4.3,
                    },
                    700: {
                        mouseDrag: true,
                        touchDrag: true,
                        itemsToShow: 2.3,
                    },
                    640: {
                        mouseDrag: true,
                        touchDrag: true,
                        itemsToShow: 1.5,
                    }

                }
            },


        }
    },
    methods: {
        alternaImagem(id) {
            this.indexAgenda = id;
            let mode = id % 2 + 1;
            return './../images/img' + mode + '.webp';
        },
    },
    mounted() {
        setTimeout(() => {
            this.bgDesktop = "url('" + this.$asset + '/images/bg-schedule-details.webp' + "')"
            this.bgMobile = "url('" + this.$asset + '/images/bg-mb-schedule-details.webp' + "')"

        }, 500)
    },
}
</script>

<template>

<!--    <Head :title="'Agenda | ' + this.$title" />-->

    <App>
        <section class="py-12 min-h-screen bg-black">



            <div class="container md:max-w-4xl w-full  relative  z-[1]">

                <h1 class="o-title text-center block mb-6 md:mb-12">
                    Agenda
                </h1>

                <aside class="grid grid-cols-1 gap-10 md:gap-16">
                    <div v-for="(schedule, index) in schedules" :key="index">
                        <h2 class="text-white/60 uppercase font-medium mt-4 text-2xl md:text-4xl w-full mb-6 md:mb-8">
                            {{
                                new Date(index.split('-')[1]).toLocaleDateString('pt-BR', {
                                    month: "long", timeZone: 'UTC'
                                })
                            }}

                            {{
                                new Date(index.split('-')[0]).toLocaleDateString('pt-BR', {
                                    year: "numeric", timeZone: 'UTC'
                                })
                            }}
                        </h2>

                        <div class="grid grid-cols-1 gap-8 md:gap-9">
                            <template v-for="item in schedule">
                                <div class="c-list-schedule__item ">
                                    <div class="relative w-16">
                                        <div class="flex-1 flex flex-col justify-center items-center gap-2">
                                            <p class="c-list-schedule__day">
                                                {{
                                                    new Date(item.date.split(' ')[0].replace(/-/g,
                                                        "/")).toLocaleDateString('pt-BR', {
                                                            day: 'numeric', timeZone: 'UTC'
                                                        })
                                                }}
                                            </p>

                                            <p class="c-list-schedule__month">
                                                {{
                                                    new Date(item.date.split(' ')[0].replace(/-/g,
                                                        "/")).toLocaleDateString('pt-BR', {
                                                            month: 'long', timeZone: 'UTC'
                                                        })
                                                }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="w-full md:w-auto md:h-full border-b md:border-r border-1 border-white ">
                                    </div>

                                    <div
                                        class="h-full flex-1 flex flex-col items-center justify-center relative z-[2] gap-3 md:gap-5">

                                        <template v-if="!item.corporate">
                                            <div v-if="!item.distrito_age" class="w-full flex flex-col justify-center">
                                                <p class="c-list-schedule__name">
                                                    {{ item.name }}
                                                </p>

                                                <p class="c-list-schedule__city">
                                                    {{ item.city_name }} - {{ item.state_uf }}
                                                </p>
                                            </div>

                                            <div v-else class="flex-1 flex justify-end">
                                                <p class="text-sm font-light text-white uppercase"
                                                    :title="item.distrito_age + 'é distrito de ' + item.nome_cid + ' ' + item.uf_est">
                                                    {{ item.distrito_age }} | {{ item.uf_est }}
                                                </p>
                                            </div>
                                        </template>

                                        <div v-else class="w-full flex-1 flex items-center">
                                            <p class="c-list-schedule__corporate">
                                                Evento Corporativo
                                            </p>
                                        </div>
                                    </div>

                                    <Button v-if="!item.corporate" :href="route('agenda', item.url)" class="text-white px-4 rounded"  color="primary" >
                                        Mais detalhes
                                    </Button>
                                </div>
                            </template>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </App>
</template>

<style src="./style.scss" lang="scss" scoped />

<style lang="scss" scoped>
/*.bg-schedule-details {
    background: v-bind(bgDesktop);

    @media (max-width: 768px) {
        background: v-bind(bgMobile);

    }
}*/
</style>
