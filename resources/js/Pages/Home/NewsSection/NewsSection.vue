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
    <section class="py-12 relative pb-0 md:pb-36 bg-secondary c-news" id="news">
        <div class="container w-screen flex items-center h-full">
            <a :href="'/noticia/'+ news.url" class="flex flex-col xl:flex-row ">
                <div class="z-[3] block w-full column lg:column-12 lg:w-96 lg:line-clamp-6">
                    <h2 class="relative block text-4xl font-bold leading-5 text-white mb-14 md:text-6xl" data-aos="fade-up" data-aos-delay="700">NOTÍCIAS</h2>
                    <h3 class="z-20 text-lg max-w-96 md:max-h-screen font-semibold text-1xl leading-6 lg:text-4xl text-[#CF2151] line-clamp-5" data-aos="fade-up" data-aos-delay="400">{{ news.title }}</h3>
                </div>
                <div class="relative w-full md:h-[350px] md:w-[590px] bg-primary top-5 md:top-20 left-0 md:right-16 m-0">
                    <figure class="c-news__image relative aos-init aos-animate" data-aos="fade-up" data-aos-easing="ease" data-aos-delay="500">
                        <img class="z-30 " alt="Noticia Marcello Teodoro" :src="news.image_cdn" style="display: block;" loading="lazy">
                    </figure>
                </div>
                <div class="w-full relative md:-left-0 mt-8 text-left lg:w-80 column sm:column-3 lg:column-11 lg:mt-20">
                    <div class="mb-10 text-base text-right line-clamp-4 md:text-left md:line-clamp-3 lg:line-clamp-5 md:text-xl md:text-primary text-white">
                        <p v-html="news.text" data-aos="fade-up" data-aos-delay="400"></p>
                    </div>

                    <span class="relative md:top-0 -top-6 md:left-0 left-10 font-bold c-news__button c-button aos-init aos-animate text-[#CF2151]">+ CONTINUAR LENDO</span>
                </div>
            </a>
        </div>
    </section>

</template>

<style src="./style.scss" lang="scss" scoped></style>
