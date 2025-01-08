<script setup>
import * as func from '@/Helpers/functions'
</script>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    props: {
        item: Object,
        index: Number,
        type: String,
    },
    components: {
        Link
    },
    data() {
        return {
            isChecked: '',
            bgImpar: '',
            bgPar: '',
        }
    },
    methods: {
        alternaImagem(id) {
            this.indexAgenda = id;
            let mode = id % 2 + 1;
            return this.$asset + '/images/img' + mode + '.webp';
        },
    }
}
</script>

<template>
    <template v-if="!item.corporate">

        <a :href="route('agenda', item.url)" class="c-schedule__item"
            :class="type === 'square' ? 'c-schedule__item--square' : ''">
<!--            <div class="bg-schedule"></div>-->
            <!-- <div class="bg-schedule bg-primary" ></div> -->


            <div class="h-full bg-primary hover:bg-primary-dark rounded-xl flex flex-col items-center gap-4 justify-between relative z-[2] p-6 ">
                <!-- <img v-lazy="$asset + '/images/bg-impar.webp'" alt="" class="absolute z-0 filter grayscale opacity-0 hover:opacity-100"> -->
                <div class="flex flex-col items-center w-full z-10">
                    <p class="c-schedule__month ">
                        {{
                            new Date(item.date.split(' ')[0].replace(/-/g, "/")).toLocaleDateString('pt-BR', {
                                month:
                                    'long'
                            })
                        }}
                    </p>

                    <p class="c-schedule__day">{{ item.date.split('-')[2] }}</p>

                </div>

                <template v-if="!item.corporate">
                    <div v-if="!item.distrito_age" class="w-full flex flex-col justify-center  gap-1 z-10">
                        <p class="c-schedule__city">
                            {{ item.city_name }}
                        </p>

                        <p class="c-schedule__state">{{ item.state_uf }}</p>

                        <span v-if="show_time_site" class="text-secondary font-semibold text-lg h-[0.5rem]">{{ item.show_time_site ?
                           func.hourFormat(item.time) + 'H' : '' }} </span>
                    </div>

                    <div v-else class="flex-1 flex justify-centr z-10">
                        <p class="text-sm font-light text-white uppercase"
                            :title="item.distrito_age + 'é distrito de ' + item.nome_cid + ' ' + item.uf_est">
                            {{ item.distrito_age }} | {{ item.uf_est }}
                        </p>
                    </div>
                </template>

                <div v-else class="w-full flex-1 flex items-end z-10">
                    <p class="c-schedule__corporate flex-1">
                        Evento Corporativo
                    </p>
                </div>

                <span class="c-schedule__details z-10">+ Mais detalhes</span>
            </div>

        </a>
    </template>

    <template v-else>
        <div class="c-schedule__item" :class="type === 'square' ? 'c-schedule__item--square' : ''">

            <div class="h-full bg-primary hover:bg-primary-dark rounded-xl  flex flex-col items-center gap-4 justify-between relative z-[2] p-6 ">
                <div class="flex flex-col items-center w-full ">
                    <p class="c-schedule__month">
                        {{
                            new Date(item.date.split(' ')[0].replace(/-/g, "/")).toLocaleDateString('pt-BR', {
                                month:
                                    'long'
                            })
                        }}
                    </p>

                    <p class="c-schedule__day">
                        {{
                            new Date(item.date.split(' ')[0].replace(/-/g, "/")).toLocaleDateString('pt-BR', {
                                day:
                                    'numeric'
                            })
                        }}
                    </p>
                </div>

                <div class="w-full flex-1 flex items-start ">
                    <p class="c-schedule__corporate">
                        Evento Corporativo
                    </p>
                </div>
            </div>
        </div>
    </template>

</template>

<style src="./style.scss" lang="scss" scoped />

<style lang="scss">
.bg-schedule {
    //background: v-bind(bgImpar);
    background-repeat: no-repeat;
    opacity: 0;

}

/*.swiper-slide {
    height: auto;

    &:nth-child(even) {
        .c-schedule {

            &__item {
                .bg-schedule {
                    background: v-bind(bgPar);
                }
            }
        }
    }
}*/
</style>
