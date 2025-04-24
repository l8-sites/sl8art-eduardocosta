<script>
import {send} from "@/Helpers/Api";

export default {
    data() {
        return {
            news: [],
        }
    },
    async mounted() {
        const data = await send('new_emphasis');
        this.news = data[0];
    }
}
</script>

<template>
    <section class="py-12 bg-secondary c-news" id="news">
        <div class="container flex items-center h-full">
            <a :href="'/noticia/'+ news.url" class="flex flex-col xl:flex-row ">
                <div class="z-[3] block w-full column lg:column-12 lg:w-96 lg:line-clamp-6">
                    <h2 class="relative block text-4xl font-bold leading-5 text-white mb-14 md:text-6xl">NOTÍCIAS</h2>
                    <h3 class="text-xl font-semibold leading-6 lg:text-4xl text-primary line-clamp-5">{{ news.title }}</h3>
                </div>
                <div class="z-[3] w-full lg:w-[500px] column sm:column-5 lg:column-12 rounded lg:rounded-none">
                    <figure class="c-news__image aos-init aos-animate" data-aos="fade-up" data-aos-easing="ease" data-aos-delay="500">
                        <img class="z-10 " alt="Noticia Marcello Teodoro" :src="news.image_cdn" style="display: block;" loading="lazy">
                    </figure>
                </div>
                <div class="w-full mt-8 text-left lg:w-80 column sm:column-3 lg:column-12 lg:mt-20">
                    <div class="mb-10 text-base text-left line-clamp-3 lg:line-clamp-5 md:text-xl text-primary">
                        <p v-html="news.text"></p>
                    </div>

                    <span class="font-bold c-news__button c-button aos-init aos-animate text-primary">+ CONTINUAR LENDO</span>
                </div>
            </a>
        </div>
    </section>

</template>

<style src="./style.scss" lang="scss" scoped></style>
