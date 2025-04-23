<script setup>
import { socialClick } from "@/Helpers/Api";
</script>

<script>
import Icon from "@/Components/Icon/Icon.vue";
import {Inertia} from "@inertiajs/inertia";
import { onMounted, onUnmounted } from "vue";


export default {
    name: "SocialMenu",
    props: {
        active : Boolean,
    },
    components: {
        Icon,
    },
    data() {
        return {
            basic: this.$inertia.page.props.siteConfig.basic_configurations[0],
            menu: this.$inertia.page.props.siteConfig.menus,
        }
    },
    emits :['close']
}
</script>

<template>

    <section>


        <div class="left-0 flex items-center lg:justify-between w-full absolute z-[3] top-0 justify-center">
            <h1  class="c-social__title" :class="!route().current('home') ? 'w-64 lg:w-[230px] ' : 'w-[70%] lg:w-64'">
                <a href="/" class="" aria-label="logo Marcello Teodoro">
                    <img :src="basic.logo_cdn" :alt="'Logo ' + basic.meta_title" class="hero-logo">
                </a>
            </h1>



            <button type="button" class="top-3 c-header-mb__item o-hamburguer" :class="[active ? 'active' : '']"
                @click="$emit('toggle')" aria-label="menu">
                <div class="trace">
                    <span></span>
                </div>
            </button>





            <ul class="c-social-menu">
                <li v-if="basic.facebook">
                    <button type="button" @click="socialClick(basic.facebook, 'facebook')" class="c-social-menu__item" aria-label="facebook">
                        <Icon name="icon-facebook-round" class="c-social-menu__icon"/>
                    </button>
                </li>

                <li v-if="basic.instagram" data-link_externo="instagram" data-link_local="menu" target="_blank">
                    <button @click="socialClick(basic.instagram, 'instagram')" class="c-social-menu__item" type="button" aria-label="instagram">
                        <Icon name="icon-instagram-round" class="c-social-menu__icon"/>
                    </button>
                </li>

                <li v-if="basic.spotify" data-link_externo="spotify" data-link_local="menu" target="_blank">
                    <button class="c-social-menu__item" @click="socialClick(basic.spotify, 'spotify')" type="button" aria-label="spotify">
                        <Icon name="icon-spotify-round" class="c-social-menu__icon"/>
                    </button>
                </li>

                <li v-if="basic.tiktok" data-link_externo="tiktok" data-link_local="menu" target="_blank">
                    <button @click="socialClick(basic.tiktok, 'tiktok')" class="c-social-menu__item" type="button" aria-label="tiktok">
                        <Icon name="icon-tiktok-round" class="c-social-menu__icon"/>
                    </button>
                </li>
                <!-- <li v-if="basic.twitter">
                    <button type="button" @click="socialClick(basic.twitter, 'twitter_x')" aria-label="Twitter"   class="c-social-menu__item">
                        <Icon name="icon-x-round" class="c-social-menu__icon" />
                    </button>
                </li>
                <li v-if="basic.youtube">
                    <button type="button" @click="socialClick(basic.youtube, 'youtube')" aria-label="Youtube" class="c-social-menu__item">
                        <Icon name="icon-youtube-round" class="c-social-menu__icon"/>
                    </button>
                </li>
                <li v-if="basic.youtube_music">
                    <button type="button" @click="socialClick(basic.youtube_music, 'youtube_music')" aria-label="Youtube Music" class="c-social-menu__item">
                        <Icon name="" class="c-social-menu__icon"/>
                    </button>
                </li> -->
            </ul>
        </div>



    </section>

</template>

<style src="./style.scss" lang="scss" ></style>




