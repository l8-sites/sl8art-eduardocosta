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

export default defineComponent({
    name: "Header",
    props: {
        orientation: String,
        sidebar: Boolean,
        active: Boolean,
    },
    components: {
        NavigationMenu,
        SocialMenu,
        Icon,
        Link
    },
    data() {
        return {
            isActive: false,
            scrollActive: false,
            isLargeScreen: useMediaQuery('(min-width: 768px)'),
            basic: this.$inertia.page.props.siteConfig.basic_configurations[0],
            bgSocial: this.$inertia.page.props.siteConfig.site_configuration_people[0].bgdesk_social_cdn,
        }
    },
    emits: ['close'],
    mounted() {
        this.verificaUrl()
        window.addEventListener('scroll', this.scrollMenu);
    },
    methods: {
        goto(hash, position) {
            if (route().current('home')) {
                var element = document.getElementById(hash);
                var headerOffset = this.isLargeScreen ? position : 0;

                var elementPosition = element.offsetTop;
                var offsetPosition = elementPosition - headerOffset;
                document.documentElement.scrollTop = offsetPosition;
                document.body.scrollTop = offsetPosition; // For Safari
                this.$emit('close', false)
            } else {
                window.localStorage.setItem('anchorMenu', hash)

                window.localStorage.setItem('positionMenu', position)

                Inertia.visit(route('home'))
            }
        },
        toggleHumburger() {
            this.isActive = !this.isActive;
            document.body.classList.toggle('active');
            if (this.isActive) {
                document.body.style.overflow = 'hidden'
            } else {
                document.body.style.overflow = 'auto'
            }

        },
        removeHumburger() {
            this.isActive = false;
            document.body.classList.remove('active');
            document.body.style.overflow = 'auto'
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
        scrollMenu() {
            if (window.scrollY >= 20) {
                this.scrollActive = true
            } else {
                this.scrollActive = false
            }
        },
    },
})
</script>

<template>

    <header>
        <div class="c-header" :class="[scrollActive ? 'active' : '']">
            <div class="container relative">
                <div class="grid grid-cols-3">


                    <a href="/">
                        <img :src="basic.logo_cdn" class="object-contain object-left h-0 transition-all duration-300 ease-in-out" :class="[scrollActive ? ' md:h-10' : 'md:h-12']"
                            :alt="'Logo ' + basic.meta_title_cdn" fetchpriority="high" />

                    </a>

                    <button type="button" class="c-header__item o-hamburguer mx-auto"
                        :class="[isActive ? 'active' : '']" @click="toggleHumburger">
                        <div class="trace">
                            <span></span>
                        </div>

                    </button>

                    <SocialMenu class="ml-auto" />
                </div>
            </div>
        </div>

        <div class="fixed right-0 px-3 py-4 top-36 bg-secondary hidden z-[12]">
            <SocialMenu />
        </div>

        <NavigationMenu :sidebar="true" @close="removeHumburger()" @toggle="toggleHumburger" :active="isActive" />


        <div class="c-sidebar-desktop " :class="[isActive ? 'active' : '']">
            <div
                class="relative w-full max-w-[1240px] bg-no-repeat bg-center bg-cover h-full flex flex-col items-center justify-center">

                <NavigationMenu orientation="" @close="toggleHumburger()" />



                <a href="https://l8.digital" target="_blank"
                    class="border-t border-secondary/20 w-screen absolute bottom-0 left-[50%] translate-x-[-50%] ">
                    <div class="container py-4">
                        <div class="flex items-center">
                            <div class="w-1/2 border-r-[1px]  pr-4 border-secondary">
                                <p class="text-sm font-medium italic text-end mb-0 leading-none text-secondary">
                                    <small>Desenvolvido <br>
                                        especialmente para,<br> <strong class="font-bold">{{ $title
                                            }}</strong></small>
                                </p>
                            </div>

                            <div class="w-1/2 flex items-center pl-4">
                                <Icon name="logo-l8" class="w-9 h-7 fill-secondary" />
                                <div>
                                    <p class="fs-6 text-base font-medium italic pl-3 mb-0 leading-none text-secondary">
                                        <small>Tudo de <br>
                                            novo</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>

        <div class="c-sidebar-mb md:hidden" :class="[isActive ? 'active' : '']">
            <div class="w-[80px] py-10 bg-secondary flex flex-col items-center gap-40">
                <p class="text-social mx-auto">Social</p>
                <SocialMenu />
            </div>

            <div class="flex-1 flex items-center pb-16 pl-10 md:pl-0 relative bg-white">
                <NavigationMenu orientation="vertical" @close="toggleHumburger()" />

                <a href="https://l8.digital" target="_blank"
                    class=" w-full  absolute bottom-0 left-0 font-secondary border-t border-secondary/30">
                    <div class="px-4 py-3">
                        <div class="flex items-center">
                            <div class="w-1/2 border-r-[1px]  pr-4 border-secondary/30">
                                <p class="text-sm font-medium italic text-end mb-0 leading-none font-sans text-secondary">
                                    <small>Desenvolvido <br>
                                        especialmente para,<br> <strong class="font-semibold ">{{ $title
                                            }}</strong></small>
                                </p>
                            </div>

                            <div class="w-1/2 flex items-center pl-4">
                                <Icon name="logo-l8" class="w-9 h-7 fill-secondary" />
                                <div>
                                    <p class="font-sans text-sm font-medium italic pl-3 mb-0 leading-none text-secondary"><small>Tudo de
                                            <br>
                                            novo</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>


    </header>

</template>

<style src="./style.scss" lang="scss" scoped />
