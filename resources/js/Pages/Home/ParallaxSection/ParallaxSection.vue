<script>

import {useMediaQuery} from "@vueuse/core";

export default {
    props: {
        background: String,
        speed: Number,
        height: String
    },
    mounted() {
        // console.log(this.$inertia.page.props.siteConfig.site_configuration_people[0])
        window.addEventListener('scroll', this.handleScroll);
    },
    methods: {
        handleScroll() {
            const cols = document.querySelectorAll('.c-parallax');

            [].forEach.call(cols, (e)=>{
                for (let i = 0; i < cols.length; i++) {
                    let top = cols[i].offsetTop;
                    let yPos = -(window.top.scrollY - top) / this.speed;
                    cols[i].style.backgroundPosition = '50% ' + yPos + 'px';
                }
            });
        }
    },
    data() {
        return {
            bgDesktop: "url('" + this.$inertia.page.props.siteConfig.site_configuration_people[0].bgdesk_parallax_02_cdn+ "')",

        }
    },
}
</script>

<template>
<!--    <pre>{{this.$inertia.page.props.siteConfig.site_configuration_people}}</pre>-->
    <section class="c-parallax" :class="height" :style="{'background-image': bgDesktop }"></section>
</template>

<style src="./style.scss" lang="scss" scoped/>

<style lang="scss" >
.c-parallax {
    background-position: center center;
    background-attachment: fixed !important;
    background-size: cover;
    background-repeat: no-repeat !important;

    @media (max-width: 768px) {
        //background: v-bind(bgMobile);
    }
}
</style>
