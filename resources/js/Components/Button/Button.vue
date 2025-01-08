<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    size: String,
    color: String,
    type: String,
    disabled: {
        type: Boolean,
        default: false,
    },
    loading: {
        type: Boolean,
        default: false,
    }
});

const defaultClasses = computed(() => 'flex items-center justify-center whitespace-nowrap uppercase text-center font-semibold focus:outline-none transition font-secondary');

const sizeClasses = computed(() => {
    switch (props.size) {
        case 'xs':
            return 'text-xs px-4 py-2';
        case 'sm':
            return 'text-sm px-4 py-2';
        case 'lg':
            return 'm:text-lg px-0 py-2 md:py-2.5';
        default:
            return 'text-base leading-none px-3 md:px-4 py-3';
    }
});

const colorsClasses = computed(() => {
    switch (props.color) {
        case 'primary':
            return 'bg-primary  hover:bg-transparent border-2 border-primary text-black hover:text-primary ';
        case 'secondary':
            return 'bg-secondary hover:bg-secondary-dark text-tertiary';
         case 'white':
            return 'bg-white hover:bg-transparent border-2 border-white text-black hover:text-white';
        case 'gray':
            return 'bg-gray hover:bg-gray text-black';
        case 'outline-primary':
            return 'border border-primary  text-primary';
        case 'outline-light':
            return 'border border-black dark:border-white  text-black dark:text-white hover:bg-black dark:hover:bg-white hover:text-white dark:hover:text-black';
        case 'outline-dark':
            return 'border border-black  text-black hover:bg-white hover:bg-black/10';
        case 'outline-red':
            return 'border border-red  text-red hover:bg-red hover:text-white hover:bg-black/10 stroke-red hover:stroke-white';
        case 'outline-custom':
            return 'border border-black  text-primary rounded-none hover:bg-white/40 hover:border-colorsecondary hover:text-black';
        case 'black':
            return 'border border-black bg-black text-white hover:bg-black-light ease-in';
        case 'black-light':
            return ' bg-black text-white hover:bg-black-light ease-in bg-black-dark border border-white-dark dark:border-black-light ease-in';
        case 'black-dark':
            return 'border border-black dark:border-white bg-black text-white hover:bg-black-light dark:bg-white dark:text-black dark:hover:bg-white-dark ease-in';
        case 'success':
            return 'bg-primary  text-white';
        case 'blue':
            return 'bg-blue hover:bg-blue-dark text-white';
        case 'warning':
            return 'bg-yellow hover:bg-yellow-dark text-black';
        case 'danger':
            return 'bg-red hover:bg-red-dark text-black';
        case 'pink':
            return 'bg-pink hover:bg-pink-dark text-white';
        case 'outline-colorful':
            return 'colorful border text-black ';
        case 'link':
            return 'text-black px-0 py-0 hover:underline hover:opacity-60 shadow-transparent';
        default:
            return 'text-base px-4 py-2';
    }
});

const loadingClasses = computed(() => {
    if (props.loading) {
        switch (props.color) {
            case 'primary':
                return 'is-loading before:text-gray before:border-r-primary';
            case 'black':
                return 'is-loading before:text-white/90 before:border-r-black';
            case 'success':
                return 'is-loading before:text-white/90 before:border-r-light';
            default:
                return '';
        }
    }
});

const disabledClasses = computed(() => {
    if (props.disabled) {
        switch (props.color) {
            case 'success':
                return 'disabled:hover:gray-light disabled:bg-gray-light disabled:border-gray-light disabled:cursor-not-allowed';
            case 'black':
                return 'disabled:hover:bg-black-light disabled:bg-black-light disabled:cursor-not-allowed';
        }
    }
});
</script>

<template>
    <button v-if="props.type === 'button' || props.type === 'submit'" :type="props.type"
        :disabled="props.disabled || props.loading"
        :class="[defaultClasses, sizeClasses, colorsClasses, loadingClasses, disabledClasses]">
        <slot />
    </button>
    <a v-else-if="props.type === 'a'" v-bind="$attrs" :disabled="props.disabled || props.loading"
        :class="[defaultClasses, sizeClasses, colorsClasses, loadingClasses, disabledClasses]">
        <slot />
    </a>
    <Link v-else v-bind="$attrs" :disabled="props.disabled || props.loading"
        :class="[defaultClasses, sizeClasses, colorsClasses, loadingClasses, disabledClasses]">
    <slot />
    </Link>
</template>

<style lang="scss" scoped>
.colorful {
    //border: 1px solid #fff;
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    border: solid 1px transparent;
    background-image: linear-gradient(#511EDA, #FD0478, #FFCD5A, #23E5F6), linear-gradient(101deg, #511EDA, #FD0478, #FFCD5A, #23E5F6);
    background-origin: border-box;
    background-clip: content-box, border-box;
    box-shadow: 1px 1000px 1px #fff inset;

    &:hover {
        box-shadow: 1px 1000px 1px #eaeaea inset;
    }
}

.is-loading {
    color: transparent !important;
    justify-content: center;
    align-items: center;
    cursor: not-allowed;
    position: relative;
    overflow: hidden;

    &::before {
        content: '';
        height: 26px;
        width: 26px;
        color: rgba(179, 176, 176, .6);
        position: absolute;
        display: inline-block;
        border: 3px solid;
        border-radius: 50%;
        border-right-color: rgba(179, 176, 176, 0);
        animation: rotate .75s linear infinite;
        z-index: 1;
    }

    &::after {

        @apply content-[''] absolute top-0 left-0 w-full h-full bg-gray-light border-2 z-[0];

    }

    @keyframes rotate {
        0% {
            transform: rotate(0);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    &:hover {
        color: transparent;

        svg {
            fill: transparent;
        }
    }
}
</style>
