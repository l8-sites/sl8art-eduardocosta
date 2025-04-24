<script setup>
import { socialClick } from "@/Helpers/Api";
</script>

<script>
import Icon from "@/Components/Icon/Icon.vue";

export default {
    name: "SocialMenu",
    components: {
        Icon
    },
    data() {
        return {
            basic: this.$inertia.page.props.siteConfig.basic_configurations[0],
        }
    }
}
</script>

<template>
    <ul class="flex flex-col md:flex-row items-center gap-3.5">

        <li v-if="basic.facebook">
            <button type="button" class="block scale-90 hover:scale-100 transition-all ease-in-out"
                @click="socialClick(basic.facebook, 'facebook')" aria-label="Facebook">
                <Icon name="icon-facebook-round" class="w-9 h-9 fill-white md:hidden" />
                <Icon name="icon-facebook-round" class="hidden lg:w-9 lg:h-9 fill-white  md:block" />
            </button>
        </li>

        <li v-if="basic.instagram">
            <button type="button" class="block scale-90 hover:scale-100 transition-all ease-in-out"
                @click="socialClick(basic.instagram, 'instagram')" aria-label="Instagram">
                <Icon name="icon-instagram-round" class="w-9 h-9 fill-white md:hidden" />
                <Icon name="icon-instagram-round" class="hidden lg:w-9 lg:h-9 fill-white  md:block" />
            </button>
        </li>

        <li v-if="basic.twitter">
            <button type="button" class="block scale-90 hover:scale-100 transition-all ease-in-out"
                @click="socialClick(basic.twitter, 'twitter_x')" aria-label="Twitter">
                <Icon name="icon-x-round" class="w-9 h-9 fill-white md:hidden" />
                <Icon name="icon-x-round" class="hidden lg:w-9 lg:h-9 fill-white  md:block" />
            </button>
        </li>

        <li v-if="basic.youtube">
            <button type="button" class="block scale-90 hover:scale-100 transition-all ease-in-out"
                @click="socialClick(basic.youtube, 'youtube')" aria-label="Youtube">
                <Icon name="icon-youtube-round" class="w-9 h-9 fill-white md:hidden" />
                <Icon name="icon-youtube-round" class="hidden lg:w-9 lg:h-9 fill-white  md:block" />
            </button>
        </li>

        <li v-if="basic.spotify">
            <button type="button" class="block scale-90 hover:scale-100 transition-all ease-in-out"
                @click="socialClick(basic.spotify, 'spotify')" aria-label="Spotify">
                <Icon name="icon-spotify-round" class="w-9 h-9 fill-white md:hidden" />
                <Icon name="icon-spotify-round" class="hidden lg:w-9 lg:h-9 fill-white  md:block" />
            </button>
        </li>

        <li v-if="basic.tiktok">
            <button type="button" class="block scale-90 hover:scale-100 transition-all ease-in-out"
                @click="socialClick(basic.tiktok, 'tiktok')" aria-label="Tiktok">
                <Icon name="icon-tiktok-round" class="w-9 h-9 fill-white md:hidden" />
                <Icon name="icon-tiktok-square" class="hidden lg:w-9 lg:h-9 fill-white  md:block" />
            </button>
        </li>
    </ul>
</template>
