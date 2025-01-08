<script>
import {defineAsyncComponent, defineComponent} from "vue";
import Header from "@/Components/Header/Header.vue";

const FooterSing = defineAsyncComponent(() => import('@/Components/FooterSing/FooterSing.vue'))
const AdsScript = defineAsyncComponent(() => import('@/Components/AdsScript/AdsScript.vue'))

export default defineComponent(  {
    name: "AppSite",
    components: {
        Header,
        AdsScript,
        FooterSing
    },
});
</script>

<template>
    <Header/>

    <main>
        <slot/>
    </main>

    <FooterSing/>

    <AdsScript/>
</template>


