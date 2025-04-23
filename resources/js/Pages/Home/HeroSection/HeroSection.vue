<script>
import NavigationMenu from "@/Components/NavigationMenu/NavigationMenu.vue";
// import SocialMenu from "@/Components/SocialMenu/SocialMenu.vue";
import { Link } from '@inertiajs/inertia-vue3';
import { defineAsyncComponent, defineComponent } from 'vue'
// import Icon from "@/Components/Icon/Icon.vue";
import { useMediaQuery } from '@vueuse/core'
// const NavigationMenu = defineAsyncComponent(() => import('@/Components/NavigationMenu/NavigationMenu.vue'))
const SocialMenu = defineAsyncComponent(() => import('@/Components/SocialMenu/SocialMenu.vue'))
const Icon = defineAsyncComponent(() => import('@/Components/Icon/Icon.vue'))
const Header = defineAsyncComponent(() => import('@/Components/Header/Header.vue'))

export default {

    components: {
        NavigationMenu,
        SocialMenu,
        Icon,
        Link,
        Header
    },
    data() {
        return {
            basic: this.$inertia.page.props.siteConfig.basic_configurations[0],
            isActive: false,
            isLargeScreen: useMediaQuery('(min-width: 768px)'),

            bgDesktop: "url('" + this.$inertia.page.props.siteConfig.site_configuration_people[0].bgdesk_home_cdn + "')",
            bgMobile: "url('" + this.$inertia.page.props.siteConfig.site_configuration_people[0].bgmobile_home_cdn + "')",

            tela: window.innerWidth,
        }
    },
    computed: {
        background () {
            return this.tela < 1024 ? this.bgMobile : this.bgDesktop;
        }
    },
    mounted() {
        window.addEventListener("resize", this.updateScreenWidth);
    },
    beforeUnmount() {
        window.removeEventListener("resize", this.updateScreenWidth);
    },
    methods: {
        updateScreenWidth() {
            this.tela = window.innerWidth;
        }
    }

}
</script>

<template>
    <section class="relative c-hero" id="hero" :style="{'background-image': background}">

        <div class="container relative h-full">

            <div class="c-hero__deslize">
                <p class="z-[1] leading-6  text-primary font-semibold text-sm md:text-base tracking-wide mb-1.5">Deslize para navegar</p>
                <div class="flex justify-center z-1 c-home__icon-down z-[3]">
                    <Icon name="icon-down" class="w-8 h-8 fill-primary"/>
                </div>
            </div>
        </div>


    </section>
</template>

<style lang="scss" src="./style.scss" scoped></style>
