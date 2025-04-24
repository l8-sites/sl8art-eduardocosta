<script>
import { Link } from "@inertiajs/inertia-vue3";
import App from "@/Pages/App.vue";
import { ref, reactive, onMounted, toRefs } from "vue";
import axios from "axios";
import CarouselGallery from "@/Components/CarouselGallery/CarouselGallery.vue";

export default {
  components: {
    Link,
    App,
    CarouselGallery,
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
    });

    onMounted(async () => {
      const linkFlickr = "https://api.flickr.com/services/rest/?&method=flickr.photosets.getList&api_key=2f0e634b471fdb47446abcb9c5afebdc&user_id=201226552@N03&primary_photo_extras=url_o,url_sq,url_t,url_q,url_s,url_m,url_l,url_z,url_b,url_h,url_k&format=json&nojsoncallback=1"
      const response = await axios.get(
        linkFlickr
      );
      data.gallery = response.data.photosets.photoset;
    });

    return { ...toRefs(data) };
  },
  mounted() {
    this.bgDesktop = "url('" + this.$inertia.page.props.siteConfig.site_configuration_people[0].bgdesk_photo_cdn + "')";
    this.bgMobile = "url('" + this.$inertia.page.props.siteConfig.site_configuration_people[0].bgmobile_photo_cdn + "')"
  },
};
</script>

<template>
  <section  id="gallery" class="c-gallery md:min-h-screen bg-black">
    <div class="container">
      <h2 class="o-title uppercase text-secondary text-start font-tertiary leading-none mx-auto relative z-[1] md:mb-4"
        data-aos="fade-up" data-aos-delay="200">
        Fotos
      </h2>
      <div class="container-gallery md:px-16">
        <CarouselGallery :gallery="gallery" class="" />
      </div>
    </div>
  </section>
</template>

<style lang="scss" src="./style.scss" scoped />
<style lang="scss">
.c-gallery {
  background: v-bind(bgDesktop) top ;
  background-repeat: no-repeat !important;
  background-position: top center !important;
  background-size: cover !important;


  @media (max-width: 768px) {
    // background: #000 v-bind(bgMobile) no-repeat center center !important;
    background-color: #000;
    background-position: top center !important;
    background-size: 150% !important;
  }
}
</style>