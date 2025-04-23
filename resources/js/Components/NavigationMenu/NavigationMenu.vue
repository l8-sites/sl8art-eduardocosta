<script>
import {Inertia} from "@inertiajs/inertia";
import Icon from "@/Components/Icon/Icon.vue";
import {useMediaQuery} from '@vueuse/core';


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
    <nav v-if="!sidebar" class=" c-nav--vertical c-nav" >
        <button type="button" class="c-nav__item " @click="goto('hero')" aria-label="Home">Home</button>

        <button type="button" v-if="menu.includes('biografia')" class="c-nav__item" @click="goto('biography', 70)" aria-label="Biography">
            Biografia
        </button>

        <button type="button" v-if="menu.includes('discografia')" class="c-nav__item" @click="goto('music', 70)" aria-label="Music">
            Música
        </button>

        <button type="button" v-if="menu.includes('video')" class="c-nav__item" @click="goto('video', 70)" aria-label="Video">
            Vídeo
        </button>

        <button type="button" v-if="menu.includes('social')" class="c-nav__item" @click="goto('social', 70)" aria-label="Social">
            Social
        </button>

        <button type="button" v-if="menu.includes('noticia')" class="c-nav__item" @click="goto('news', 70)" aria-label="News">
            Notícias
        </button>

        <button type="button"  class="c-nav__item" @click="goto('gallery', 70)" aria-label="Gallery">
            Fotos
        </button>

        <button type="button" v-if="menu.includes('central_fa')" class="c-nav__item" @click="goto('fa', 70)" aria-label="Fas">
            Fãs
        </button>

        <button type="button" v-if="menu.includes('contato')" class="c-nav__item" @click="goto('contact', -70)" aria-label="Contact">
            Contato
        </button>
    </nav>

    <div class="c-header-mb" v-else>

        <button type="button" class="c-header-mb__item" @click="goto('hero')" aria-label="home">
            <Icon name="icon-home" class="object-contain w-5 h-5 fill-white"></Icon>
        Home
        </button>

        <button type="button" v-if="menu.includes('contato')" class="c-header-mb__item" @click="goto('contact', 70)" aria-label="WhastsApp">
            <Icon name="icon-whatsapp" class="object-contain w-5 h-5 fill-white"></Icon>
            WhatsApp
        </button>

        <button type="button" v-if="true" class="c-header-mb__item" @click="goto('music', 70)" aria-label="Música">
            <Icon name="icon-music" class="object-contain w-5 h-5 fill-white"/>
            Música
        </button>

        <button type="button" class="h-12 c-header-mb__item o-hamburguer" :class="[active ? 'active' : '']"
                @click="$emit('toggle')" aria-label="Menu">
            <div class="trace">
                <span></span>
            </div>
            Menu
        </button>
    </div>

</template>

<style src="./style.scss" lang="scss" scoped/>

