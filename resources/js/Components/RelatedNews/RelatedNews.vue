<script>
import {Link} from '@inertiajs/inertia-vue3';

export default {
    name: "RelatedNews",
    components:{
        Link
    },
    props: {
        related: Object
    },
    mounted() {
        // console.log(this.related)
    },
}
</script>

<template>
    <div class="px-5 md:px-0">
        <p class="text-lg md:text-xl text-white font-bold mb-4 border-b-[2px] border-white">
            Leia também
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <template v-for="(item, index)  in related">
                <Link :href="route('noticia', item.url)"
                   class="c-leia hover:underline flex gap-2 text-primary">
                    <figure
                        class="c-news__image relative min-w-[130px] md:min-w-[140px]  transition ease-in-out duration-300 border-2 border-white">
                        <img class="transition ease-in-out duration-300 object-cover object-top"
                             :src="item.image_cdn"
                             :alt="item.image_subtitle" width="140" height="105"/>

                        <div class="box-number absolute bg-white left-0 bottom-0 z-1 px-1 w-8">
                            <p class="text-center font-bold text-lg md:text-xl">{{ index + 1 }}</p>
                        </div>
                    </figure>
                    <div class="flex-1 box-descricao flex flex-col text-ellipsis overflow-hidden h-[6rem]">
                        <span class="font-extrabold text-primary  text-[12px]  truncate">
                            {{ item.name }} </span>

                        <span class="font-bold text-white text-sm ">
                            {{ item.title }} </span>
                    </div>
                </Link>
            </template>
        </div>
    </div>
</template>
