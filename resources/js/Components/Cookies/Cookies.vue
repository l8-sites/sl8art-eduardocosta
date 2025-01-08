<script>
import {defineAsyncComponent} from "vue";

const Button = defineAsyncComponent(() => import('@/Components/Button/Button.vue'))
const Icon = defineAsyncComponent(() => import('@/Components/Icon/Icon.vue'))

export default {
    data() {
        return {
            isChecked: ''
        }
    },
    components: {
        Button,
        Icon
    },
    methods: {
        cookies(event) {
            this.isChecked = localStorage.setItem("isChecked", this.isChecked)
        },
        initIsChecked() {
            const stored = localStorage.getItem("isChecked")
            if (stored === null) {
                return true
            } else {
                return stored == 'true'
            }
        }
    },
    mounted() {
        setTimeout(() => {
            this.isChecked = this.initIsChecked()
        }, 7500)
    },
    watch: {
        isChecked: function () {
            localStorage.setItem("isChecked", this.isChecked)
        }
    }
}
</script>

<template>
    <div class="c-cookies" v-bind:class="(isChecked) ? 'showCookies' : ''">
        <div class="container max-w-5xl c-cookies__content rounded-lg bg-white-light">
            <div class="md:flex items-center justify-between gap-3 md:gap-6">
                <div class="flex gap-3">
                    <div class="w-auto flex mb-2 md:mb-0">
                        <Icon name="icon-cookies" class="w-7 h-7 md:w-9 md:h-9 fill-black" />
                    </div>
                    <div class="flex-1 mb-3 md:mb-0">
                        <p class="text-sm text-black font-secondary">
                            Nós usamos cookies e outras tecnologias semelhantes para melhorar a sua experiência em
                            nossos serviços. Ao utilizar nossos
                            serviços, você concorda com tal monitoramento conforme descrito em nossa
                            <a :href="route('politica-privacidade')" class="font-bold hover:opacity-90">Política de
                                Privacidade</a>.
                        </p>
                    </div>
                </div>

                <div class="w-full md:w-2/12">
                    <Button  size="" type="button" class="w-full justify-center bg-black text-white py-2" @click="cookies()">
                        Prosseguir
                    </Button>
                </div>
            </div>
        </div>
    </div>
</template>

<style src="./style.scss" lang="scss" scoped/>
