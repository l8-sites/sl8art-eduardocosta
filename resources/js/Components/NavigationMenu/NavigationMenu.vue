<script>
import { Inertia } from "@inertiajs/inertia";
import Icon from "@/Components/Icon/Icon.vue";
import { useMediaQuery } from '@vueuse/core';


export default {
    name: "NavigationMenu",
    props: {
        orientation: String,
        sidebar: Boolean,
        active: Boolean,
    },
    components: {
        Icon,
    },
    data() {
        return {
            menu: this.$inertia.page.props.siteConfig.menus,
            isLargeScreen: useMediaQuery('(min-width: 768px)')
        }
    },
    emits: ['close'],
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

    },
}
</script>

<template>


    <nav v-if="!sidebar" class="c-nav" :class="orientation === 'vertical' ? 'c-nav--vertical' : ''">

        <button type="button" class="c-nav__item" @click="goto('hero')">
<!--            <figure class="figure-menu md:flex hidden">-->
<!--                <img :src="$asset + '/images/menu01.webp'" alt="" class="w-full object-cover" />-->
<!--            </figure>-->
            Home
        </button>

        <!-- <a href="/agenda"  v-if="menu.includes('agenda')" class="c-nav__item" >
            <figure class="figure-menu md:flex hidden">
                <img :src="$asset + '/images/menu02.webp'" alt="" class="w-full object-cover" />
            </figure>
            Agenda
        </a> -->

        <button type="button" class="c-nav__item" @click="goto('biography', 0)">
<!--            <figure class="figure-menu md:flex hidden">-->
<!--                <img :src="$asset + '/images/menu02.webp'" alt="" class="w-full object-cover" />-->
<!--            </figure>-->
            Biografia
        </button>

        <button type="button" class="c-nav__item" @click="goto('music', 0)">
<!--            <figure class="figure-menu md:flex hidden">-->
<!--                <img :src="$asset + '/images/menu03.webp'" alt="" class="w-full object-cover" />-->
<!--            </figure>-->
            Música
        </button>

        <button type="button" class="c-nav__item" @click="goto('video', 0)">
<!--            <figure class="figure-menu md:flex hidden">-->
<!--                <img :src="$asset + '/images/menu04.webp'" alt="" class="w-full object-cover" />-->
<!--            </figure>-->
            Vídeos
        </button>

        <button type="button" class="c-nav__item" @click="goto('fa', 0)">
<!--            <figure class="figure-menu md:flex hidden">-->
<!--                <img :src="$asset + '/images/menu05.webp'" alt="" class="w-full object-cover" />-->
<!--            </figure>-->
            Fã Clube
        </button>

        <!-- <button type="button" v-if="menu.includes('social')" class="c-nav__item" @click="goto('social', 70)">

            Social
        </button>

        <button type="button" v-if="menu.includes('noticia')" class="c-nav__item" @click="goto('news', 70)">

            Notícias
        </button>

        <a href="https://www.instagram.com/luansantana/" target="_blank" class="c-nav__item">
            <figure class="figure-menu md:flex hidden">
                <img :src="$asset + '/images/menu07.webp'" alt="" class="w-full object-cover" />
            </figure>
            Fotos
        </a> -->

        <button type="button" v-if="menu.includes('contato')" class="c-nav__item" @click="goto('contact', 0)">
<!--            <figure class="figure-menu md:flex hidden">-->
<!--                <img :src="$asset + '/images/menu06.webp'" alt="" class="w-full object-cover" />-->
<!--            </figure>-->
            Contato
        </button>


    </nav>

    <div class="c-header-mb" v-if="sidebar">

        <!-- <button type="button" class="c-header-mb__item" @click="goto('hero')">
            <Icon name="icon-home" class="object-contain h-5 w-5 fill-white"></Icon>
            Home
        </button> -->

        <button type="button" v-if="menu.includes('contato')" class="c-header-mb__item" @click="goto('contact', 70)">
            <Icon name="icon-mail" class="object-contain h-[1.5rem] w-[1.5rem] stroke-white"></Icon>
            Contato
        </button>

        <button type="button" v-if="menu.includes('discografia')" class="c-header-mb__item" @click="goto('music', 70)">
            <Icon name="icon-music" class="object-contain h-[1.375rem] w-6 fill-white stroke-2 stroke-white"></Icon>
            Músicas
        </button>

        <button type="button" class="c-header-mb__item o-hamburguer" :class="[active ? 'active' : '']"
            @click="$emit('toggle')">
            <div class="trace">
                <span></span>
            </div>
            Menu
        </button>
    </div>
</template>

<style src="./style.scss" lang="scss" scoped />
