<script setup>
import Icon from '@/Components/Icon/Icon.vue'

import {computed} from "vue";

const props = defineProps({
    show: Boolean,
    size: {
        type: String,
        default: '550px',
    },
})

const sizeClasses = computed(() => {
    switch (props.size) {
        case 'md' :
            return 'w-full md:w-[768px]';
        case 'lg' :
            return 'w-full md:w-[1080px]';
        default:
            return 'w-full md:w-[550px]';
    }
});
</script>

<template>
    <Transition name="modal">
        <div v-if="show" class="modal-mask">
            <div class="container flex justify-end pt-4 md:pt-4">
                <button type="button" class="modal-default-button font-black text-xl text-center hover:opacity-70" @click="$emit('close')">
                    <Icon name="icon-close" class="w-4 md:w-6 object-contain fill-white"/>
                </button>
            </div>
            <div class="modal-wrapper">
                <div class="modal-container" :class="[sizeClasses]">
                    <div class="modal-header">
                        <slot name="header"></slot>
                    </div>

                    <div class="modal-body py-4 px-5">
                        <slot name="body"></slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<style src="./style.scss" lang="scss" />
