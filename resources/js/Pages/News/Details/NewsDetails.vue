<script setup>
import * as func from '@/Helpers/functions'
</script>

<script>
import {defineAsyncComponent, ref} from "vue";
import {Link} from '@inertiajs/inertia-vue3';
import App from "@/Pages/App.vue";
import Button from '@/Components/Button/Button.vue'
import Icon from '@/Components/Icon/Icon.vue'


const Tags = defineAsyncComponent(() => import('@/Components/Tags/Tags.vue'))
const TextArticle = defineAsyncComponent(() => import('@/Components/TextArticle/TextArticle.vue'))
const RelatedNews = defineAsyncComponent(() => import('@/Components/RelatedNews/RelatedNews.vue'))
const ProgressBar = defineAsyncComponent(() => import('@/Components/ProgressBar/ProgressBar.vue'))

export default {
    components: {
        App,
        Button,
        Icon,
        TextArticle,
        RelatedNews,
        ProgressBar,
        Tags,
        Link,

    },
    props: {
        news: Object,
        newsTags: Object,
    },
    data() {
        return {
            url: window.location.href,
            progress: 0,
            titleNews: '',
        }
    },
    methods: {
        onScroll() {
            const {documentElement, body} = document;
            let windowScroll = body.scrollTop || documentElement.scrollTop;
            let height = documentElement.scrollHeight - documentElement.clientHeight;
            this.progress = (windowScroll / height);
        }
    },
    mounted() {
        window.addEventListener("scroll", this.onScroll)

        this.titleNews = this.news.title
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.onScroll)
    },
    watch: {
        titleNews(newValue) {
            document.title = newValue + ' - ' + this.$title; // Atualiza o título da página
        }
    },
}
</script>


<template>

    <Head :title="titleNews"/>

    <App>
        <section class="md:pt-8 md:pb-16 pb-12 relative bg-secondary md:z-0 z-[11] text-section">
            <div class="max-w-2xl mx-auto ">
                <div class="w-full grid grid-cols-1 gap-8">
                    <div class="flex flex-col gap-3 md:pt-0">
                        <div class="order-1 md:order-3">
                            <template v-if="news.image && news.video == null">

                                <figure class="c-news__image c-news__image--shadow md:block hidden">
                                    <img :src="news.image_cdn" :alt="news.title" width="768" height="580" class="object-cover object-top md:block hidden"/>
                                </figure>

                                <div class="c-news__caption" v-if="news.image_subtitle || news.image_source" >
                                        <span v-if="news.image_subtitle" class="text-sm text-white uppercase font-semibold md:block hidden">
                                            {{ news.image_subtitle }}
                                        </span>

                                    <span v-if="news.image_source" class="text-xs text-white md:block hidden">
                                            Fonte: {{ news.image_source }}
                                        </span>
                                </div>
                            </template>

                            <div v-if="news.video != null">
                                <Video :video="news.video"/>
                            </div>
                        </div>

                        <div class="order-2 md:order-1 px-5 md:px-0">

                            <div v-if="news.emphasis" class="md:hidden w-full mb-3 flex">
                                <p class="bg-primary text-black  text-sm uppercase font-black py-[6px] px-4 mx-auto">
                                    Exclusivo
                                </p>
                            </div>

                            <h1 v-if="news.title"
                                class="font-bold text-[#CF2151] text-3xl md:text-4xl lg:leading-[1.15] text-center md:text-left order-3 md:order-2 mb-6">
                                {{ news.title }}
                            </h1>

                            <p v-if="news.subtitle"
                               class="text-white text-center md:text-left text-base lg:text-lg order-4 md:order-3 mb-6">
                                {{ news.subtitle }}
                            </p>

                            <div
                                class="flex flex-col px-5 md:px-0 items-center md:items-start gap-3 order-5 md:order-2">
                                <div class="flex items gap-1">
                                    <div v-if="news.emphasis" class="hidden md:block">
                                        <p class="bg-primary rounded-sm text-base text-baclk uppercase font-bold py-[6px] px-4 flex items-center">
                                            Exclusivo</p>
                                    </div>

                                    <div class="flex gap-1">
                                        <a :href="'https://api.whatsapp.com/send?text=' + url + '/' + news.url"
                                           target="_blank" aria-label="Whatsapp"
                                           class="bg-[#21bd5b] hover:bg-[#1da851] transition rounded-sm ease-in-out duration-300 text-xs text-white font-black py-2 px-6 flex items-center">
                                            <Icon name="icon-whatsapp"
                                                  class="h-5 w-5 object-contain fill-white"/>
                                        </a>
                                        <a :href="'https://telegram.me/share/url?url=' + url + '/' + news.url"
                                           target="_blank" aria-label="telegram"
                                           class="bg-[#0088cc] hover:bg-[#467dab] transition rounded-sm ease-in-out duration-300 text-xs text-white font-black py-2 px-6 flex items-center">
                                            <Icon name="icon-telegram"
                                                  class="h-5 w-5 object-contain fill-white"/>
                                        </a>
                                        <a :href="'https://www.facebook.com/sharer/sharer.php?u=' + url + '/' + news.url"
                                           target="_blank" aria-label="facebook"
                                           class="bg-[#4267B2] hover:bg-[#185ab1] transition rounded-sm ease-in-out duration-300 text-xs text-white font-black md:py-2 px-6  flex items-center">
                                            <Icon name="icon-facebook-fill"
                                                  class="h-5 w-5 object-contain fill-white"/>
                                        </a>
                                        <a :href="'https://twitter.com/intent/tweet?url=' + url + '/' + news.url + '&text=' + news.title"
                                           target="_blank" aria-label="twitter"
                                           class="bg-[#202020] hover:bg-[#000000] transition rounded-sm ease-in-out duration-300 text-xs text-white font-black md:py-2 px-6 flex items-center">
                                            <Icon name="icon-x"
                                                  class="h-5 w-5 object-contain fill-white"/>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items gap-2 px-5 md:px-0 mt-6">
                                <p class="text-white/70 text-xs md:text-sm font-normal">
                                        <span>Por <strong class="font-bold">{{
                                                news.author ? news.author : this.$title
                                            }}</strong> - </span> Atualizado {{
                                        func.dateFormat(news.date, news.date)
                                    }}
                                </p>
                            </div>
                        </div>

                        <TextArticle :description="news.text" class="mt-5"/>

                        <Tags v-if="news.tags.length > 0" :tags="news.tags" class="order-8"/>

                        <RelatedNews v-if="newsTags.length > 0" :related="newsTags" class="order-10"/>

                        <a :href="route('noticias')" class="text-sm bg-primary md:text-sm border mx-4 md:mx-0 px-4 py-3 rounded-md font-bold text-white uppercase text-center mt-7 tracking-widest block order-11">
                            Veja mais notícias
                        </a>
                    </div>
                </div>


            </div>
        </section>

        <ProgressBar :value="progress"/>
    </App>
</template>

<style src="./style.scss" lang="scss" scoped/>
