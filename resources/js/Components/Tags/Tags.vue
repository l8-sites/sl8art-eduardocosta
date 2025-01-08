<script>
export default {
    name: "Tags",
    props: {
        tags: Object
    },
}
</script>

<template>
    <ul class="flex flex-wrap item-center gap-1.5 my-4 px-5 md:px-0">
        <li v-for="(item, index) in tags" :key="index">
            <div
               class="text-black bg-white border border-black uppercase rounded-md text-sm md:text-base font-semibold py-1.5 leading-none px-3 hover:bg-black hover:text-white transition ease-in-out duration-300">
                {{ item }}
            </div>
        </li>
    </ul>
</template>
