<script>

import { Link } from '@inertiajs/inertia-vue3';
import Icon from "@/Components/Icon/Icon.vue";
import { useMediaQuery } from '@vueuse/core'


export default {

    components: {

        Icon,
        Link

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
        background() {
            return this.tela < 1024 ? this.bgMobile : this.bgDesktop;
        }
    },


}
</script>

<template>
    <section class="c-hero" id="hero" :style="{ 'background-image': background }">

        <div class="container relative h-full">

            <div class="c-hero__deslize">
                <p class="z-[1] leading-6  text-white font-normal text-sm md:text-base tracking-wider mb-1.5">Deslize
                    para navegar</p>
                <div class="flex justify-center z-1 c-home__icon-down z-[3]">
                    <Icon name="icon-down" class="w-7 h-7 fill-primary" />
                </div>
            </div>
        </div>


    </section>
</template>

<style lang="scss" src="./style.scss" scoped></style>
