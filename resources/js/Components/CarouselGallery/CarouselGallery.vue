<script>

import axios from "axios";
import VueEasyLightbox from 'vue-easy-lightbox'
import { ref, reactive, toRefs, onMounted, watch } from "vue";
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Pagination, Navigation, Autoplay, Keyboard } from 'swiper';
import { PhArrowLeft, PhArrowRight } from "@phosphor-icons/vue";
import Icon from "@/Components/Icon/Icon.vue";
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';

export default {

    components: {
        Swiper,
        SwiperSlide,
        VueEasyLightbox,
        Icon,
        PhArrowRight,
        PhArrowLeft,
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
                    slidesPerView: 3,


                },
                '768': {
                    slidesPerView: 2,


                },
                '1024': {
                    slidesPerView: 3,


                },
                '1366': {
                    slidesPerView: 3,

                },
                '1600': {
                    slidesPerView: 3,

                },
            },

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
    setup(props) {
        const visible = ref(false);
        const indexImage = ref(0);
        const imgUrl = ref([]);
        const threeImgs = ref([]);
        const nameAlbuns = ref([]);
        const currentAlbumIndex = ref(0);

        // Function to fetch albums
        async function searchAlbuns(id) {
            try {
                const response = await axios.get(
                    `https://api.flickr.com/services/rest/?&method=flickr.photosets.getPhotos&api_key=2f0e634b471fdb47446abcb9c5afebdc&photoset_id=${id}&extras=description,views,url_o,url_sq,url_t,url_q,url_s,url_m,url_l,url_z,url_b,url_h,url_k&format=json&nojsoncallback=1`
                );
                const photos = response.data.photoset?.photo;

                nameAlbuns.value = response.data.photoset.title

                if (photos) {
                    imgUrl.value = photos.map(photo => photo.url_z);
                    if (window.innerWidth > 1280) {
                        threeImgs.value = photos.slice(0, 4);
                    } else if (window.innerWidth > 1024) {
                        threeImgs.value = photos.slice(0, 3);
                    } else if (window.innerWidth > 768) {
                        threeImgs.value = photos.slice(0, 2);
                    } else {
                        threeImgs.value = photos.slice(0, 1);
                    }
                    const images = document.getElementsByClassName('box-image');
                    for (let i = 0; i < images.length; i++) {
                        images[i].classList.remove('loaded');
                    }

                    for (let i = 0; i < images.length; i++) {
                        setTimeout(() => {
                            images[i].classList.add('loaded');
                        }, 300 * (i + 1));
                    }

                }


            } catch (error) {
                console.error("Error fetching photos:", error);
            }
        }

        // Watch for changes in the gallery prop
        watch(() => props.gallery, (newGallery) => {
            if (newGallery.length > 0) {
                searchAlbuns(newGallery[0].id);
            }
        }, { immediate: true });

        function nextAlbum() {
            if (currentAlbumIndex.value < props.gallery.length - 1) {
                currentAlbumIndex.value++;
            } else {
                currentAlbumIndex.value = 0;
            }
            searchAlbuns(props.gallery[currentAlbumIndex.value].id);
        }

        function prevAlbum() {
            if (currentAlbumIndex.value > 0) {
                currentAlbumIndex.value--;
            } else {
                currentAlbumIndex.value = props.gallery.length - 1;
            }
            searchAlbuns(props.gallery[currentAlbumIndex.value].id);
        }

        function onShow() {
            visible.value = true;
        }

        function onHide() {
            visible.value = false;
        }

        return {
            visible,
            indexImage,
            imgUrl,
            threeImgs,
            nameAlbuns,
            nextAlbum,
            prevAlbum,
            onShow,
            onHide
        };
    }
}

</script>

<template>
    <vue-easy-lightbox :visible="visible" :imgs="imgUrl" :index="0" @hide="onHide" :maskClosable="false">
    </vue-easy-lightbox>

    <div class="grid-gallery w-full">
        <div v-for="(item, index) in threeImgs" :key="index" class="box-image loaded">
            <picture class="box-image__img" @click="onShow">
                <source media="(max-width: 699px)" :srcset="item.url_m" />
                <img :src="item.url_z" alt="Fotos de eventos" class="gallery-img" />
            </picture>
        </div>

        <div
            class="flex md:hidden items-center justify-between gap-4 absolute top-[50%] left-[50%] translate-x-[-50%] w-[calc(100%+1rem)]">
            <button type="button"
                class="swiper-nav-button custom-prev-button bg-white hover:bg-white/40 border border-white p-2 rounded-full "
                @click="prevAlbum" aria-label="Botão navegação para esquerda">
                <PhArrowLeft class="w-6 h-6 fill-black" />
            </button>

            <button type="button"
                class="swiper-nav-button custom-next-button bg-white hover:bg-white/40 border border-white p-2 rounded-full "
                @click="nextAlbum" aria-label="Botão navegação para direita">
                <PhArrowRight class="w-6 h-6 fill-black" />
            </button>
        </div>
    </div>
    <div class="flex items-center justify-center gap-4">
        <button type="button"
            class="swiper-nav-button custom-prev-button bg-white hover:bg-white/40 border border-white p-2 rounded-full hidden md:block"
            @click="prevAlbum" aria-label="Botão navegação para esquerda">
            <PhArrowLeft class="w-6 h-6 fill-black" />
        </button>

        <div class="box-city  w-[20rem]" @click="onShow">
            <span>{{ nameAlbuns }}</span>
        </div>

        <button type="button"
            class="swiper-nav-button custom-next-button bg-white hover:bg-white/40 border border-white p-2 rounded-full hidden md:block"
            @click="nextAlbum" aria-label="Botão navegação para direita">
            <PhArrowRight class="w-6 h-6 fill-black" />
        </button>
    </div>



</template>


<style src="./style.scss" lang="scss" scoped />
<style lang="scss">
.carousel__prev,
.carousel__next {
    background-color: transparent !important;
}

.swiper-slide {
    transition: .3s ease-in-out;
}

.swiper-slide-duplicate {
    opacity: 0;
}

.swiper-slide-next,
.swiper-slide-prev,
.swiper-slide-active {
    opacity: 100% !important;
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
    transform: translate(calc(-50% - 2rem)) !important;
}

.carousel__icon {
    fill: transparent !important;
    ;
}

/*
    @media (min-width: 768px) {
        .carousel__prev,
        .carousel__next {
            display: none;
        }
    }
    */
.grid-gallery {
    @apply grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 justify-center relative w-full -mb-8 md:mb-14 md:min-h-[21em];

    .box-image {
        @apply w-full h-[15rem] md:opacity-0 md:w-[calc(100%+4rem)] aspect-[4/3] md:h-0 mt-10 md:mt-20 even:mt-0 relative bg-[#cccccc] hover:bg-fourth p-[1rem] cursor-pointer transition-all ease-in-out duration-300;






        //even:ml-[-4rem] last:ml-[-8rem]
        &:before {
            @apply content-[''] absolute -top-8 left-[50%] translate-x-[-50%] h-8 w-[8rem] z-[1] bg-black;

        }

        &__img {

            @apply absolute top-[1rem] left-[1rem] w-[calc(100%-2rem)] h-[calc(100%-2rem)] overflow-hidden;

            img {
                @apply scale-[1.7] h-[16rem] w-full object-cover transition-all ease-in-out duration-300 md:scale-100 rotate-0;






            }

        }


        &.loaded {

            @apply md:h-[16rem] opacity-100;

            img{
                @apply scale-100;
            }

        }


        &:hover {
            img {
                @apply md:scale-110 rotate-3;
            }
        }

    }
}

.box-city {
    @apply border-4 border-white hover:border-fourth bg-black-light text-2xl md:text-3xl text-white font-bold px-4 py-2 md:py-4 md:px-8 rounded-xl block uppercase relative shadow-2xl font-tertiary w-[22rem] text-center truncate cursor-pointer transition-all ease-in-out duration-300;

    background-image: conic-gradient(from 20deg, rgb(60, 59, 57, 1) 50%, rgb(119, 119, 118, 1) 50%);

    &::before {
        @apply content-[''] absolute top-0 left-0 h-full w-full z-[0];
        background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0) 20%, rgba(0, 0, 0, 1));
    }

    &:hover {
        background-image: conic-gradient(from 20deg, rgb(60, 59, 57, 0.4) 50%, rgb(119, 119, 118, 0.4) 50%);
    }


    span {
        @apply relative z-[1];
        text-shadow: 3px 3px 10px black;

    }
}


:root {
    --vc-icn-width: 4em;
    --vc-nav-width: 50px;
}
</style>