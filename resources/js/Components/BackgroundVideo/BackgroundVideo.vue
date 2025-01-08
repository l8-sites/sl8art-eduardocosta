<template>
    <div class="c-bgvideo">
        <VideoBackground class="video" :src="video" :autoplay="true" :muted="true" :playsinline="true"
            loop />
    </div>
</template>

<script>
// import VideoBackground from 'vue-responsive-video-background-player'
export default {
    // name: "BackgroundVideo",
    // components: {
    //     VideoBackground,
    // },
    data(){
        return{
            video: this.$inertia.page.props.siteConfig.site_configuration_people[0].bgvideo_desk_cdn
        }
    }
}
</script>

<style lang="scss" scoped>
.c-bgvideo {
    width: 100%;
    height: 100vh;
    position: absolute;
    top: 0;
    left: 0;
    pointer-events: none;
    z-index: -1;

    .video {
        width: 100%;
        height: 100%;
    }

    &:before {
        content: '';
        // background: url("/images/texture.png") repeat;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        opacity: 0.5;
    }

    &:after {
        content: '';
        background: #000;
        opacity: .60;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
    }
}
</style>
