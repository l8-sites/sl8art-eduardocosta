<script>
import { defineComponent} from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import Icon from "@/Components/Icon/Icon.vue";
import Cookies from "@/Components/Cookies/Cookies.vue"
import Button from "@/Components/Button/Button.vue"
// const Cookies = defineAsyncComponent(() => import('@/Components/Cookies/Cookies.vue'))

export default defineComponent( {
    name: "FooterSing",
    components: {
        Icon,
        Button,
        Link,
        Cookies
    },
    props: {
        backgroundColor: '',
        color: ''
    },
    data() {
        return {
            isChecked: this.initIsChecked()
        }
    },
    methods: {
        cookies(event) {
            this.isChecked = localStorage.setItem("isChecked", this.isChecked);
        },

        initIsChecked: function () {
            const stored = localStorage.getItem("isChecked");
            if (stored === null) {
                return true;
            } else {
                return stored == 'true';
            }
        }
    },
    watch: {
        isChecked: function () {
            localStorage.setItem("isChecked", this.isChecked);
        }
    }
})
</script>

<template>
    <footer class="pb-[62px] md:pb-0">
        <a href="https://l8.digital" target="_blank" class="sing" :style="{ background: backgroundColor }">
            <div class="container p-3 md:p-5">
                <div class="flex items-center">
                    <div class="w-1/2 border-r-[1px]  pr-4 border-white" :style="{ 'border-color': color }">
                        <p class="text-xs font-light italic text-white text-end mb-0 leading-none" :style="{ 'color': color }">
                            <small>Desenvolvido <br>
                                especialmente para,<br> <strong class="font-semibold">{{ $title
                                    }}</strong></small>
                        </p>
                    </div>

                    <div class="w-1/2 flex items-center pl-4">
                        <Icon name="logo-l8" class="w-10 h-10 fill-white" :style="{ 'fill': color }" />
                        <div>
                            <p class="fs-6 italic pl-3 mb-0 font-light leading-none text-white" :style="{ 'color': color }"><small>Tudo de <br>
                                novo</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </footer>

    <Cookies/>
</template>

<style src="./style.scss" lang="scss" scoped/>
