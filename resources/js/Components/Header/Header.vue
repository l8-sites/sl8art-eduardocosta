<script setup>
import {Inertia} from "@inertiajs/inertia";
import { socialClick } from "@/Helpers/Api";
</script>

<script>
import NavigationMenu from "@/Components/NavigationMenu/NavigationMenu.vue";
// import SocialMenu from "@/Components/SocialMenu/SocialMenu.vue";
import { Link } from '@inertiajs/inertia-vue3';
import { defineAsyncComponent, defineComponent } from 'vue'
import Icon from "@/Components/Icon/Icon.vue";
import { useMediaQuery } from '@vueuse/core'
// const NavigationMenu = defineAsyncComponent(() => import('@/Components/NavigationMenu/NavigationMenu.vue'))
const SocialMenu = defineAsyncComponent(() => import('@/Components/SocialMenu/SocialMenu.vue'))
// const Icon = defineAsyncComponent(() => import('@/Components/Icon/Icon.vue'))

export default defineComponent({
    name: "Header",
    components: {
        NavigationMenu,
        SocialMenu,
        Icon,
        Link
    },
    data() {
        return {
            isActive: false,
            isLargeScreen: useMediaQuery('(min-width: 768px)'),
            basic: this.$inertia.page.props.siteConfig.basic_configurations[0]
        }
    },
    methods: {
        toggleHumburger() {
            this.isActive = !this.isActive;
            document.body.classList.toggle('active');


        },
        removeHumburger() {
            this.isActive = false;
            document.body.classList.remove('active');
        },
        verificaUrl() {
            if (window.localStorage.getItem("anchorMenu")) {
                let anchor = localStorage.getItem("anchorMenu");
                let position = localStorage.getItem("positionMenu");

                setTimeout(() => {
                    var element = document.getElementById(anchor);
                    var headerOffset = this.isLargeScreen ? position : 0;

                    var elementPosition = element.offsetTop;
                    var offsetPosition = elementPosition - headerOffset;
                    document.documentElement.scrollTop = offsetPosition;
                    document.body.scrollTop = offsetPosition; // For Safari
                    document.body.classList.remove('active');
                    this.$emit('close', false)
                }, 500)

                window.localStorage.setItem('anchorMenu', '');
                window.localStorage.setItem('positionMenu', '');
            }
        },
    },
    mounted() {
        this.verificaUrl()
    }
})
</script>

<template>
    <header >


        <NavigationMenu :sidebar="true" @close="removeHumburger()" @toggle="toggleHumburger" :active="isActive"/>
        <div class="c-sidebar-mb" :class="[isActive ? 'active' : 'overflow-auto']">

            <div class="c-sidebar-mb" :class="[isActive ? 'active' : '']">
                <div class="w-[80px] py-10 bg-secondary items-center gap-40 flex flex-col lg:hidden">
                    <p class="mx-auto text-social">Social</p>

                    <div class="w-full h-[320px] flex items-center justify-start z-[2] flex-col relative gap-5 ">
                        <a href="/" v-if="basic.facebook">
                            <Icon name="icon-facebook-round" @click="socialClick(basic.facebook, 'facebook')" class="c-social-menu__icon hover:fill-white"/>
                        </a>
                        <a href="/" v-if="basic.instagram" target="_blank">
                            <Icon name="icon-instagram-round" @click="socialClick(basic.instagram, 'instagram')" class="c-social-menu__icon hover:fill-white"/>
                        </a>
                        <a href="/" v-if="basic.youtube" target="_blank">
                            <Icon name="icon-youtube-round" @click="socialClick(basic.youtube, 'youtube')" class="c-social-menu__icon hover:fill-white"/>
                        </a>
                        <a href="/" v-if="basic.spotify" target="_blank">
                            <Icon name="icon-spotify-round" @click="socialClick(basic.spotify, 'spotify')" class="c-social-menu__icon hover:fill-white"/>
                        </a>
                        <a href="/" v-if="basic.tiktok" target="_blank">
                            <Icon name="icon-tiktok-round" @click="socialClick(basic.tiktok, 'tiktok')" class="c-social-menu__icon hover:fill-white"/>
                        </a>
                        <a href="/" v-if="basic.twitter" target="_blank">
                            <Icon name="icon-x-round" @click="socialClick(basic.twitter, 'twitter-x')" class="c-social-menu__icon hover:fill-white"/>
                        </a>
                    </div>


                </div>

                <div class="relative flex items-center flex-1 ">
                    <NavigationMenu orientation="vertical" @close="toggleHumburger()" />

                    <a href="https://l8.digital" target="_blank"
                        class="absolute bottom-0 left-0 w-full bg-black font-secondary lg:hidden">
                        <div class="container py-3">
                            <div class="flex items-center">
                                <div class="w-1/2 border-r-[1px]  pr-4 border-white">
                                    <p class="mb-0 text-xs italic leading-none text-white text-end">
                                        <small>Desenvolvido <br>
                                            especialmente para,<br> <strong class="font-semibold">{{ $title
                                                }}</strong></small>
                                    </p>
                                </div>

                                <div class="flex items-center w-1/2 pl-4">
                                    <Icon name="logo-l8" class="w-9 h-7 fill-white" />
                                    <div>
                                        <p class="pl-3 mb-0 text-sm italic leading-none text-white fs-6"><small>Tudo de <br>
                                                novo</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="c-sidebar-lg">

            </div>
        </div>

        <SocialMenu :sidebar="true" @close="removeHumburger()" @toggle="toggleHumburger" :active="isActive"
            class="container relative top-0 left-0 lg:z-20"
        />

        
    </header>
</template>

<style lang="scss" src="./style.scss"></style>
