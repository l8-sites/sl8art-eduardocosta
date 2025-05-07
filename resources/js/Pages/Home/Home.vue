<script>
import { Link, Head } from "@inertiajs/inertia-vue3";
import { defineAsyncComponent } from "vue";
import App from "@/Pages/App.vue";
import HeroSection from "@/Pages/Home/HeroSection/HeroSection.vue";

const BiographySection = defineAsyncComponent(() =>
  import("@/Pages/Home/BiographySection/BiographySection.vue")
);
const ScheduleSection = defineAsyncComponent(() =>
  import("@/Pages/Home/ScheduleSection/ScheduleSection.vue")
);
const MusicSection = defineAsyncComponent(() =>
  import("@/Pages/Home/MusicSection/MusicSection.vue")
);
const NewsSection = defineAsyncComponent(() =>
  import("@/Pages/Home/NewsSection/NewsSection.vue")
);
const ParallaxSection = defineAsyncComponent(() =>
  import("@/Pages/Home/ParallaxSection/ParallaxSection.vue")
);
const FanSection = defineAsyncComponent(() =>
  import("@/Pages/Home/FanSection/FanSection.vue")
);
const GallerySection = defineAsyncComponent(() =>
  import("@/Pages/Home/GallerySection/GallerySection.vue")
);
const VideoSection = defineAsyncComponent(() =>
  import("@/Pages/Home/VideoSection/VideoSection.vue")
);
const SocialSection = defineAsyncComponent(() =>
  import("@/Pages/Home/SocialSection/SocialSection.vue")
);
const ContactSection = defineAsyncComponent(() =>
  import("@/Pages/Home/ContactSection/ContactSection.vue")
);
const BannerPopup = defineAsyncComponent(() =>
  import("@/Pages/Home/BannerPopup/BannerPopup.vue")
);
const StoreSection = defineAsyncComponent(() =>
  import("@/Pages/Home/StoreSection/StoreSection.vue")
);

export default {
  components: {
    App,
    HeroSection,
    BiographySection,
    MusicSection,
    ScheduleSection,
    NewsSection,
    ParallaxSection,
    FanSection,
    GallerySection,
    ContactSection,
    VideoSection,
    SocialSection,
    StoreSection,
    Link,
    Head,
  },
  data() {
    return {
      menu: this.$inertia.page.props.siteConfig.menus,
      bgParallax1: this.$inertia.page.props.siteConfig.site_configuration_people[0]
        .bgdesk_parallax_01_cdn,
      bgParallax2: this.$inertia.page.props.siteConfig.site_configuration_people[0]
        .bgdesk_parallax_02_cdn,
      flickrId: this.$inertia.page.props.siteConfig.configurations[0].flickrid,
      flickrAlbum: this.$inertia.page.props.siteConfig.configurations[0].flickralbum,
      bgVideoDesk: '',
      linkYoutube: '',
    };
  },
};
</script>

<script setup>
import { useMediaQuery } from "@vueuse/core";
const isLargeScreen = useMediaQuery("(min-width: 768px)");
</script>

<template>

  <Head :title="$title" />

  <App>
    <HeroSection />

    <ScheduleSection />

    <BiographySection />

    <MusicSection />

    <VideoSection />

      <GallerySection/>

    <ParallaxSection />

    <NewsSection />

    <FanSection />

    <ContactSection />

  </App>
</template>
