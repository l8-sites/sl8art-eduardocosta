<script>
import {send} from "@/Helpers/Api";

export default {
    data() {
        return {
            bio: [],
        }
    },
    async mounted() {
        const data = await send('history');
        this.bio = data[0];
    },
    // methods: {
    //     replaceByDefault(e) {
    //         e.target.src = "https://picsum.photos/200/300"
    //         console.log("oi")
    //     }
    // }
}
</script>

<template>
    <section id="biography">
        <div class="py-12 lg:py-20 c-biography">
            <div class="container grid grid-cols-1 gap-32 md:grid-cols-2">
                <img :src="bio.image_cdn" alt="Imagem Biografia" class="w-full rounded z-[2] lg:h-full" >
                <div class="content-center justify-end text-xl">
                    <h2 class="text-[#ffffff] block text-4xl lg:text-6xl font-bold mb-10 uppercase">Biografia</h2>
                    <div class="scroll-container text-[#ffffff] text-left leading-10" v-html="bio.description "></div>
                </div>
            </div>
        </div>
    </section>
</template>


<style src="./style.scss"></style>

