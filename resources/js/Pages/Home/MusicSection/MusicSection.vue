<script setup>
import { socialClick } from "@/Helpers/Api";
import 'swiper/css';
import 'swiper/css/navigation';
</script>

<script>
import Button from "@/Components/Button/Button.vue";
import { Link } from '@inertiajs/inertia-vue3';
import App from "@/Pages/App.vue";
import { ref } from 'vue';
import Icon from '@/Components/Icon/Icon.vue'
import { send, spotify } from "@/Helpers/Api";
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Pagination, Navigation, Autoplay, Keyboard } from 'swiper';


export default {
    components: {
        App,
        Icon,
        Link,
        Swiper,
        SwiperSlide,
    },
    data() {
        return {
            albuns: [],
            artist: [],
            config: this.$inertia.page.props.siteConfig.basic_configurations[0],
            modules: [Autoplay, Navigation, Keyboard, Pagination],
            breakpoints: {
                '640': {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    centeredSlides: true,
                },
                '768': {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    centeredSlides: false,
                },
                '1024': {
                    slidesPerView: 2,
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
            profileImage: '',
            iframe: ref(''),
            idAlbum: '',
            imageAlbum: '',
            nameAlbum: '',
            idI: '',
            music: [],
            firstAlbum: '',

        }
    },
    mounted() {
        send('music')
            .then((data) => {
                this.music = data
                // console.log(data)
                this.spotifyData()
            })
        // console.log(this.config)

    },
    methods: {
        iframeHtml(idAlbum, image, name) {
            this.imageAlbum = image;
            this.nameAlbum = name;
            if (idAlbum) {
                this.iframe = '<iframe class="h-full" style="border-radius:12px" src="https://open.spotify.com/embed/album/' + idAlbum + '?utm_source=generator&theme=0" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>'
            }

        },
        goNext() {
            this.$emit('prev');
        },
        goPrev() {
            this.$emit('next');
        },
        async spotifyData() {



            if (this.music.type === 'top_tracks') {
                const resTop = await spotify('album_single_filter', {
                    'limit': this.music.amount
                })

                this.albuns = resTop

                this.firstAlbum = this.albuns[0]
            } else {
                const resAlbum = await spotify('album_single', {
                    'type': this.music.type,
                    'limit': this.music.amount
                })

                this.albuns = resAlbum





                this.firstAlbum = this.albuns[0]
            }


            if (this.music && this.albuns) {

                const favorites = this.music.favorites;

                const sortedAlbuns = [
                    ...this.albuns.filter(album => favorites.includes(album.id)),
                    ...this.albuns.filter(album => !favorites.includes(album.id))
                ];

                this.albuns = sortedAlbuns;

            }


            if (this.albuns.length > 0) {
                this.idAlbum = this.albuns.find(({ id }) => id === this.music.music_id) ? this.albuns.find(({ id }) => id === this.music.music_id) : this.firstAlbum
            }

            if (this.idAlbum.images) {
                this.imageAlbum = this.idAlbum.images[0].url
            }

             const userProfile = await spotify('followers');


            if (userProfile && userProfile.images && userProfile.images.length > 0) {
                this.profileImage = userProfile.images[0].url; // Armazena a foto de perfil
            } else {
                this.profileImage = 'URL_DE_IMAGEM_PADRAO'; // Define uma imagem padrão se não houver foto
            }

            this.nameAlbum = this.idAlbum.name
            this.iframe = '<iframe style="border-radius:12px" src="https://open.spotify.com/embed/album/' + this.albuns[0].id + '?utm_source=generator&theme=0" width="100%" height="152" frameBorder="0" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>'

        },
    }
}
</script>


<template>
    <section id="music">
        <div class="py-5 text-center bg-black c-music">
            <div class="container">
                <div class="flex items-center justify-between pt-10 mb-10 o-column" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="text-4xl lg:text-6xl o-title aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">MÚSICA</h2>
                    <div data-aos="fade-up" data-aos-easing="ease" data-aos-delay="300" class="aos-init aos-animate" >
                        <Icon name="icon-spotify" data-aos-easing="ease" data-aos-delay="300" class="hidden md:w-64 md:h-24 w-9 h-9 lg:block fill-[#1db954] "/>
                        <Icon name="icon-spotify-round" class="block lg:hidden w-12 h-12 fill-[#1db954] bg-black rounded-full stroke-black"/>
                    </div>
                </div>



                <div class="flex mt-6 mb-8 md:mt-12 md:mb-12 items-start">
                    <div class="relative left-0 flex top-4">
                        <div class="flex-col items-center lg:flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="700">
                            <div class="mr-10 xl:mr-0" v-if="imageAlbum" >
                                <figure class="w-24 h-24 mb-5 md:block hidden overflow-hidden rounded-full lg:w-44 lg:h-44">
                                    <img class="object-cover lazy" :src="profileImage" alt="Marcello Teodoro" loading="lazy">
                                </figure>
                                <a :href="config.spotify" target="_blank"
                                   class="px-9 py-2 font-semibold text-white md:relative absolute md:top-auto top-72 left-24 md:left-0 uppercase rounded-full w-max bg-success">
                                    Seguir
                                </a>
                            </div>
                        </div>

                        <div class="hidden md:block h-[152px] mx-4" v-html="iframe" title="Musica escolhida pelo usuário no carrossel do artista."></div>

                    </div>

                    <swiper class="flex-1 pt-5 pb-20 pl-2 pr-2" v-if="true" ref="swiper" :effect="'fade'" :keyboard="true" :slidesPerView="1" :spaceBetween="0" :allowTouchMove="true"
                        :grabCursor="true" :centeredSlides="false" :loop="true" slideActiveClass="active"
                        :navigation="{nextEl: '.custom-next-button', prevEl: '.custom-prev-button'}"
                        :breakpoints="breakpoints" :modules="modules">

                        <swiper-slide v-for="(item, key) in albuns" :key="key" >
                            <div class="flex flex-col ">
                                <button v-if="item.images" type="button"
                                    @click="iframeHtml(item.id, item.images[0].url, item.name)"
                                    class="hidden lg:block c-streaming__link " :aria-label="item.name">
                                    <img :src="item.images[1].url" class="rounded-md scale-150 md:scale-110 " :alt="item.name" width="400" height="400" loading="lazy">
                                </button>

                                <a v-if="item.images" :href="item.external_urls.spotify" target="_blank"
                                    class="flex content-between  lg:hidden" :aria-label="item.name">

                                    <img :src="item.images[1].url" :alt="item.name" width="300" height="300" class="c-streaming__link " loading="lazy">

                                    <button color="green" type="a" :href="item.external_urls?.spotify" target="_blank" class="c-button__play" aria-label="play">
                                        PLAY
                                    </button>
                                </a>

                            </div>

                        </swiper-slide>

                    </swiper>

                    <div class="relative right-0 z-[3] md:top-52 top-60">
                        <button type="button" @click="goPrev" class="swiper-nav-button relative top-24 md:top-0 -right-6 md:right-5 custom-next-button" aria-label="goPrev">
                            <Icon name="icon-caret-right" class="w-6 h-6 pl-2 fill-white"/>
                        </button>
                        <button type="button" @click="goNext" class=" swiper-nav-button relative top-24 md:top-0 right-80  md:right-24 custom-prev-button" aria-label="goNext">
                            <Icon name="icon-caret-left" class="w-6 h-6 pr-2 fill-white"/>
                        </button>
                    </div>

                </div>

            </div>
        </div>

        <div class="md:items-center items-center justify-center bg-primary h-full gap-5 py-5 text-center md:flex md:flex-row ">
            <p class="text-white ">OUÇA TAMBÉM NA SUA PLATAFORMA PREFERIDA</p>
            <ul class="c-streaming items-center justify-center relative flex flex-row gap-4 ">
                <li v-if="config.link_deezer">
                    <button type="button" @click="socialClick(config.link_deezer, 'deezer')" class="c-streaming__link"
                        aria-label="Deezer">
                        <Icon name="icon-deezer" class="hidden h-7 md:block fill-white hover:scale-105" />
                        <Icon name="icon-deezer-symbol" class="w-6 h-6 fill-white md:hidden " />
                    </button>
                </li>

                <li v-if="config.link_music">
                    <button type="button" @click="socialClick(config.link_music, 'apple_music')"
                        class="c-streaming__link" aria-label="Apple Music">
                        <Icon name="icon-applemusic" class="hidden h-5 md:block fill-white hover:scale-105" />
                        <Icon name="icon-applemusic-symbol" class="w-6 h-6 md:hidden fill-white" />
                    </button>
                </li>
                <li v-if="config.link_youtube_music">
                    <button type="button" @click="socialClick(config.link_youtube_music, 'youtube_music')"
                        class="c-streaming__link" aria-label="Youtube Music">
                        <Icon name="icon-youtubemusic" class="hidden h-5 md:block fill-white hover:scale-105" />
                        <Icon name="icon-youtubemusic-symbol" class="w-6 h-6 fill-white md:hidden" />
                    </button>
                </li>


                <li v-if="config.link_tidal">
                    <button type="button" @click="socialClick(config.link_tidal, 'tidal')" class="c-streaming__link"
                        aria-label="Tidal">
                        <Icon name="icon-tidal" class="hidden h-5 md:block fill-white hover:scale-105" />
                        <Icon name="icon-tidal-symbol" class="h-6 w-6 fill-white md:hidden" />
                    </button>
                </li>

                <li v-if="config.link_napster">
                    <button type="button" @click="socialClick(config.link_napster, 'napster')" class="c-streaming__link"
                        aria-label="Napster">
                        <Icon name="icon-napster" class="hidden h-6 md:block fill-white hover:scale-105" />
                        <Icon name="icon-napster-symbol" class="w-6 h-6 fill-white md:hidden" />
                    </button>
                </li>

            </ul>
        </div>

    </section>
</template>


<style src="./style.scss" lang="scss"></style>
