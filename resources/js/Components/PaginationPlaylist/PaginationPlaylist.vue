<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import {computed, reactive} from "vue";

const name = "Pagination";

const props = defineProps({
 data: Object
});

/*** LIMPA O ARRAY DE PAGINACAO DO LARAVEL ***/
const cleanLinks = computed(() => {
    const cleanLinks = props.data.links
    cleanLinks.shift();
    cleanLinks.pop();

    return cleanLinks
});

const hidePagination = computed(() => {
    return !this.data.prev_page_url && !this.data.next_page_url
});
</script>

<template>

    <div class="flex justify-between items-center mt-4">
        <Label v-if="data.to" :value="`Registro ${data.from} - ${data.to} de ${data.total}`"></Label>

        <div class="flex items-center">

            <Link v-if="data.prev_page_url" :href="data.prev_page_url" class="flex items-center justify-center w-8 h-8 mx-1 transition-colors duration-200 transform bg-white-dark dark:bg-bgadm-light rounded-md hover:bg-white-light/70 hover:bg-white-dark/50 dark:hover:bg-bgadm-light/70">
                <ChevronLeftIcon class="w-3 h-3 stroke-black-light dark:stroke-white-light" />
            </Link>

            <Link v-if="data.next_page_url" :href="data.next_page_url" class="flex items-center justify-center w-8 h-8 mx-1 transition-colors duration-200 transform bg-white-dark dark:bg-bgadm-light rounded-md hover:bg-white-dark/50 dark:hover:bg-bgadm-light/70">
                <ChevronRightIcon class="w-3 h-3 stroke-black-light dark:stroke-white-light" />
            </Link>

        </div>
    </div>

</template>
