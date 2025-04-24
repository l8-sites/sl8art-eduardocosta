<script>
import Icon from "@/Components/Icon/Icon.vue";
import { Link } from "@inertiajs/inertia-vue3";
import App from "@/Pages/App.vue";
import { send } from "@/Helpers/Api";
import { youtube } from "@/Helpers/Api";
import PaginationPlaylist from "@/Components/PaginationPlaylist/PaginationPlaylist.vue";
import { ref } from "vue";
import LiteYouTubeEmbed from 'vue-lite-youtube-embed'
import { PhArrowLeft, PhArrowRight } from "@phosphor-icons/vue";
import "vue-lite-youtube-embed/style.css";
import { Swiper, SwiperSlide } from "swiper/vue";

export default {
    components: {
        Link,
        App,
        PaginationPlaylist,
        LiteYouTubeEmbed,
        Icon,
        Swiper,
        SwiperSlide,
        PhArrowLeft,
        PhArrowRight,
    },
    props: {
        casting: Object,
    },
    data() {
        return {
            play: { video_id: '', loop: 1, autoplay: 1 },
            video_fixed: {},
            basic: this.$inertia.page.props.siteConfig.basic_configurations[0],
            bgDesktop: "",
            bgMobile: "",
            iframe: "",
            playlist: [],
            playlistPage: ref([]),
            titleVideo: "",
            page: 1,
            perPage: 3,
            totalPage: 0,
            breakpoints: {
                '640': { slidesPerView: 3, spaceBetween: 10, centeredSlides: false },
                '768': { slidesPerView: 3, spaceBetween: 10, centeredSlides: false },
                '1024': { slidesPerView: 3, spaceBetween: 20, centeredSlides: false },
                '1280': { slidesPerView: 4, spaceBetween: 30, centeredSlides: false },
                '1536': { slidesPerView: 4, spaceBetween: 30 },
            },
            videoVisible: false,
        };
    },
    methods: {
        toggleVideo() {
            this.play.youtubeid = this.video_fixed.youtubeid;
            this.videoVisible = true;
            this.playCurrentVideo(this.video_fixed.youtubeid);
        },
        async youtubePaylist() {
            const res = await youtube("playlist", 10);
            this.playlist = res.items;
            this.playlistPerPage(this.page);
            if (this.playlist?.length > 0) {
                this.titleVideo = this.playlist[0].snippet.title;
                this.iframe = this.playlist[0].snippet.resourceId.videoId;
            }
        },
        playlistPerPage(page) {
            const playlistPage = [];
            const startIndex = this.perPage * (page - 1);
            const endIndex = startIndex + this.perPage;

            for (let i = startIndex; i < endIndex; i++) {
                if (this.playlist?.length > 0) {
                    playlistPage.push(this.playlist[i]);
                }
            }
            this.playlistPage = playlistPage;
        },
        prevPage() {
            this.page--;
            this.youtubePaylist(this.page);
        },
        nextPage() {
            this.page++;
            this.youtubePaylist(this.page);
        },
        playCurrentVideo(id) {
            this.play.video_id = id;
            this.$refs.youtube.player.playVideo();
        },
        showNav(tam) {
            return tam > 5 && window.innerWidth >= 760;
        },
    },
    async mounted() {
        const response = await send('video_fixed');
        this.video_fixed = response[0];
        console.log(this.video_fixed);
    },
};
</script>


<template>
    <section id="video" class="c-video">
        <div class="container max-w-6xl  relative">
            <h2 class="o-title text-white md:text-8xl  text-center mb-6 md:mb-8">
                Vídeos
            </h2>
            <div class="box-video">

               <div v-if="videoVisible" class="absolute z-[0] top-[0.625rem] left-[0.625rem] w-[calc(100%-1.25rem)] h-[calc(100%-1.25rem)] ">
                    <iframe class="w-full h-full "
                        :src="'https://www.youtube.com/embed/' + video_fixed?.youtubeid + '?autoplay=1'"
                        title="video" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                </div>

                <button type="button" class="box-video__capa" v-if="!videoVisible" @click="toggleVideo">
                    <img alt="Capa do vídeo" :src="video_fixed.video" class="object-cover w-full h-full " />

                    <Icon name="icon-play"
                        class="icon-play" />
                </button>

              

            </div>
            <!-- <div class="relative flex items-center justify-center w-full aspect-[16/9] bg-white p-2 z-[2]">
                <img v-if="!videoVisible" alt="Capa do vídeo" :src="video_fixed.video"
                    class="object-cover w-full h-full " />
                <Icon v-if="!videoVisible" name="icon-play"
                    class="absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] w-16 md:w-20  fill-white drop-shadow-2xl"
                    @click="toggleVideo" />

                <div class="absolute z-[-1] top-0 left-0 w-full h-full ">
                    <iframe class="w-full aspect-[16/9] "
                        :src="videoVisible ? 'https://www.youtube.com/embed/' + video_fixed?.youtubeid + '?autoplay=1' : ''"
                        title="video" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                </div>
            </div> -->
        </div>
    </section>
</template>

<style src="./style.scss" lang="scss" scoped />
<style lang="scss"></style>
