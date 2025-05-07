<script>
import { Link } from "@inertiajs/inertia-vue3";
import App from "@/Pages/App.vue";
import { ref, reactive, onMounted, toRefs } from "vue";
import axios from "axios";
import CarouselGallery from "@/Components/CarouselGallery/CarouselGallery.vue";
import Icon from "@/Components/Icon/Icon.vue";

export default {
    components: {
        Link,
        App,
        CarouselGallery,
        Icon,
    },
    props: {
        flickrId: {
            type: String,
            required: true,
            default: '',
        },

        background: '',
    },
    setup() {
        const data = reactive({
            gallery: ref([]),
        })

        onMounted(async () => {

            const response = await axios.get('https://api.flickr.com/services/rest/?&method=flickr.photosets.getList&api_key=2f0e634b471fdb47446abcb9c5afebdc&user_id=37571638@N07&primary_photo_extras=url_o,url_sq,url_t,url_q,url_s,url_m,url_l,url_z,url_b,url_h,url_k&format=json&nojsoncallback=1')
            data.gallery = response.data.photosets.photoset
        })

        return { ...toRefs(data) }
    },
    mounted() {
        this.bgDesktop = "url('" + this.$inertia.page.props.siteConfig.site_configuration_people[0].bgdesk_photo_cdn + "')";
        this.bgMobile = "url('" + this.$inertia.page.props.siteConfig.site_configuration_people[0].bgmobile_photo_cdn + "')"
    },
};
</script>

<template>
    <section id="gallery" class=" c-gallery">

        <div class="container relative ">
            <h2 class="font-bold relative leading-none text-white uppercase o-title mb-12  top-6 text-start" data-aos="fade-up" data-aos-delay="700">
                Fotos
            </h2>
        </div>

        <div class="container-gallery" data-aos="fade-up" data-aos-delay="700">

            <CarouselGallery :gallery="gallery" />

        </div>
    </section>
</template>

<style lang="scss" src="./style.scss" scoped />

<style lang="scss" scoped>
// .c-gallery {
//   background: v-bind(bgDesktop) no-repeat center center !important;
//   background-size: cover !important;
//   position: relative;
//   height: 90vh;

//   @media (max-width: 768px) {
//     background: v-bind(bgDesktop) no-repeat left !important;
//     background-size: cover !important;

//   }

// &::before {
//   position: absolute;
//   content: '';
//   left: 0;
//   top: 0;
//   width: 100%;
//   height: 100%;
//   backdrop-filter: blur(7px);
//   @apply bg-secondary;

// }
// }</style>
