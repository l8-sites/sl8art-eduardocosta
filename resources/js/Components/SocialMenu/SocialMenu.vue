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
    <ul
        class="flex items-center flex-col z-[10] md:rounded-l-md lg:fixed md:px-3.5 md:py-6 md:bg-white md:top-20 md:right-0  gap-4 md:gap-4">

        <li v-if="basic.youtube">
            <button type="button" class="block" @click="socialClick(basic.youtube, 'youtube')" aria-label="Youtube">
                <Icon name="icon-youtube-round" class="w-8 h-8 fill-colorfourth md:hidden" />
                <Icon name="icon-youtube-round"
                    class="h-7 w-7 lg:w-[1.96rem] lg:h-[1.96rem] fill-black hover:fill-primary-dark hidden md:block" />
            </button>
        </li>

        <li v-if="basic.twitter">
            <button type="button" class="block" @click="socialClick(basic.twitter, 'twitter_x')" aria-label="Twitter">
                <Icon name="icon-x-round" class="w-8 h-8 fill-colorfourth md:hidden" />
                <Icon name="icon-x-round"
                    class="h-7 w-7 lg:w-[1.96rem] lg:h-[1.96rem] fill-black hover:fill-primary-dark hidden md:block" />
            </button>
        </li>

        <li v-if="basic.spotify">
            <button type="button" class="block" @click="socialClick(basic.spotify, 'spotify')" aria-label="Spotify">
                <Icon name="icon-spotify-round" class="w-8 h-8 fill-colorfourth md:hidden" />
                <Icon name="icon-spotify-round"
                    class="h-7 w-7 lg:w-[1.96rem] lg:h-[1.96rem] fill-black hover:fill-primary-dark  hidden md:block" />
            </button>
        </li>

        <li v-if="basic.instagram">
            <button type="button" class="block" @click="socialClick(basic.instagram, 'instagram')"
                aria-label="Instagram">
                <Icon name="icon-instagram-round" class="w-8 h-8 fill-colorfourth md:hidden" />
                <Icon name="icon-instagram-round"
                    class="h-7 w-7 lg:w-[1.96rem] lg:h-[1.96rem] fill-black hover:fill-primary-dark  hidden md:block" />
            </button>
        </li>

        <li v-if="basic.facebook">
            <button type="button" class="block" @click="socialClick(basic.facebook, 'facebook')" aria-label="Facebook">
                <Icon name="icon-facebook-round" class="w-8 h-8 fill-colorfourth md:hidden" />
                <Icon name="icon-facebook-round"
                    class="h-7 w-7 lg:w-[1.96rem] lg:h-[1.96rem] fill-black hover:fill-primary-dark hidden md:block" />
            </button>
        </li>

        <li v-if="basic.tiktok">
            <button type="button" class="block" @click="socialClick(basic.tiktok, 'tiktok')" aria-label="Tiktok">
                <Icon name="icon-tiktok-round" class="w-8 h-8 fill-colorfourth md:hidden" />
                <Icon name="icon-tiktok-round"
                    class="h-7 w-7 lg:w-[1.96rem] lg:h-[1.96rem] fill-black hover:fill-primary-dark  hidden md:block" />
            </button>
        </li>
    </ul>
</template>
