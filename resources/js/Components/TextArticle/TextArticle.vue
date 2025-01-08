<script>
// import {defineAsyncComponent} from "vue";
// const IconsSvg = defineAsyncComponent(() => import('@/Components/IconsSvg/IconsSvg.vue'))

export default {
    name: "TextArticle",
    props: {
        description: String
    },
    data() {
        return {

        }
    },
    components: {

    },
    mounted() {
        let parent = this.$refs["conteudo"]
        let embedContent = parent.querySelectorAll('div.raw-html-embed')

        if(parent.querySelectorAll('div.raw-html-embed').length !== 0){
            for (let i = 0; i < embedContent.length; i++){
                let tiktokEmbed = parent.querySelectorAll('div.raw-html-embed')[i].querySelector('blockquote.tiktok-embed')
                let instagramEmbed = parent.querySelectorAll('div.raw-html-embed')[i].querySelector('blockquote.instagram-media')
                let twitterEmbed = parent.querySelectorAll('div.raw-html-embed')[i].querySelector('blockquote.twitter-tweet')

                if (tiktokEmbed){
                    const scriptTiktok = document.createElement('script')
                    scriptTiktok.setAttribute('defer' , '')
                    scriptTiktok.setAttribute('src', 'https://www.tiktok.com/embed.js')
                    document.body.appendChild(scriptTiktok)
                }

                if (instagramEmbed){
                    const scriptInstagram = document.createElement('script')
                    scriptInstagram.setAttribute('defer', '')
                    scriptInstagram.setAttribute('src', '//www.instagram.com/embed.js')
                    document.body.appendChild(scriptInstagram)
                }

                if (twitterEmbed){
                    const scriptTwitter = document.createElement('script')
                    scriptTwitter.setAttribute('src', 'https://platform.twitter.com/widgets.js')
                    document.body.appendChild(scriptTwitter)
                }
            }
        }
    }
}
</script>

<template>
    <article v-html="description" class="c-article__body order-6" ref="conteudo"></article>
</template>
