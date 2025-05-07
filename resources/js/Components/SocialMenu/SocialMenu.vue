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
    <ul class="flex flex-col md:flex-row relative -z-10 items-center gap-3.5">

        <li v-if="basic.facebook">
            <button type="button" class="scale-90 hover:scale-100 transition-all ease-in-out"
                    @click="socialClick(basic.facebook, 'facebook')" aria-label="facebook">
                <Icon name="icon-facebook-round" class="block md:hidden w-9 h-9 fill-white" />
                <Icon name="icon-facebook-round" class="hidden md:block w-9 h-9 fill-white" />
            </button>
        </li>

        <li v-if="basic.instagram">
            <button type="button" class="scale-90 hover:scale-100 transition-all ease-in-out"
                    @click="socialClick(basic.instagram, 'instagram')" aria-label="Instagram">
                <Icon name="icon-instagram-round" class="block md:hidden w-9 h-9 fill-white" />
                <Icon name="icon-instagram-round" class="hidden md:block w-9 h-9 fill-white" />
            </button>
        </li>

        <li v-if="basic.twitter">
            <button type="button" class="scale-90 hover:scale-100 transition-all ease-in-out"
                    @click="socialClick(basic.twitter, 'twitter_x')" aria-label="Twitter">
                <Icon name="icon-x-round" class="block md:hidden w-9 h-9 fill-white" />
                <Icon name="icon-x-round" class="hidden md:block w-9 h-9 fill-white" />
            </button>
        </li>

        <li v-if="basic.youtube">
            <button type="button" class="scale-90 hover:scale-100 transition-all ease-in-out"
                    @click="socialClick(basic.youtube, 'youtube')" aria-label="Youtube">
                <Icon name="icon-youtube-round" class="block md:hidden w-9 h-9 fill-white" />
                <Icon name="icon-youtube-round" class="hidden md:block w-9 h-9 fill-white" />
            </button>
        </li>

        <li v-if="basic.spotify">
            <button type="button" class="scale-90 hover:scale-100 transition-all ease-in-out"
                    @click="socialClick(basic.spotify, 'spotify')" aria-label="Spotify">
                <Icon name="icon-spotify-round" class="block md:hidden w-9 h-9 fill-white" />
                <Icon name="icon-spotify-round" class="hidden md:block w-9 h-9 fill-white" />
            </button>
        </li>

<!--        <li v-if="basic.tiktok">-->
<!--            <button type="button" class="scale-90 hover:scale-105 transition-all ease-in-out"-->
<!--                    @click="socialClick(basic.tiktok, 'tiktok')" aria-label="Tiktok">-->
<!--                <Icon name="icon-tiktok-round" class="block md:hidden w-9 h-9 fill-white" />-->
<!--                <Icon name="icon-tiktok-square" class="hidden md:block w-9 h-9 fill-white" />-->
<!--            </button>-->
<!--        </li>-->

    </ul>

</template>
