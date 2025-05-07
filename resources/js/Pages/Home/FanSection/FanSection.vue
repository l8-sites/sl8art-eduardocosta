<script>
export default {
    props:{
        link: String
    },
    data() {
        return {
            bgDesktop: "url('" + this.$inertia.page.props.siteConfig.site_configuration_people[0].bgdesk_areafa_cdn + "')",
            bgMobile: "url('" + this.$inertia.page.props.siteConfig.site_configuration_people[0].bgmobile_areafa_cdn + "')",
            basic: "url('" + this.$inertia.page.props.siteConfig.site_configuration_people[0].bgdesk_photo_cdn + "')" ,
        }
    },
}
</script>

<template>
    <section id="fa" class="w-full h-[100vh] relative top-0 " :style="{ backgroundImage: basic }">
        <div class=" left-0 top-0 w-full h-[100vh] absolute">
            <div class="c-bg-fa md:min-w-full w-full top-0 absolute right-0 h-[100vh] md:h-[100vh]" :style="{ backgroundImage: bgDesktop }"
            ></div>

            <a :href="'https://centraldefas.eduardocosta.com.br/'" target="_blank" class="c-fan__box flex flex-col xl:flex-row" >

                <p id="c-titulo" class="absolute md:top-40 bottom-64 right-9 md:right-12 md:text-2xl text-xl font-normal text-center text-white uppercase font-secondary md:text-left md:block" data-aos="fade-up" data-aos-delay="400">
                    CENTRAL DE FÃS </p>
                <h2 id="c-text" class="absolute md:top-52 bottom-36 md:right-12 md:max-w-[550px] max-w-[380px] text-2xl font-semibold text-center md:text-xl md:font-semibold lg:text-5xl text-white md:text-right md:text-[#CF2151] line-clamp-6" data-aos="fade-up" data-aos-delay="400">
                    UM ESPAÇO FEITO
                    COM CARINHO PARA
                    QUEM É FÃ DE
                    VERDADE</h2>
                <div class=" absolute md:bottom-44 bottom-20 md:right-24 right-16 ">
                    <button class="bg-gray-dark rounded font-semibold text-white h-12 md:w-56 w-64 border border-white px-4 py-2 transition-all duration-300 hover:bg-transparent hover:text-white" data-aos="fade-up" data-aos-delay="400">
                    ACESSAR
                </button>
                </div>
            </a>
        </div>
    </section>
</template>

<style src="./style.scss" lang="scss" scoped/>


<style lang="scss" scoped>
.c-bg-fa {
    background-size: cover;
    background-repeat: no-repeat !important;
    background-position: center;

    /*background: v-bind(bgDesktop) no-repeat center center !important;
    background-size: cover !important;*/

    @media (max-width: 768px) {
        background-repeat: no-repeat !important;
        background-position: -170px;
        background-size: cover;
    }
}
</style>

