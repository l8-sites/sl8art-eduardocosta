<template>
    <div class="progress-bar">
        <div
            class="filled-bar bg-primary"
            :style="{ transform: `translate3d(-${(1 - value) * 100}%, 0, 0)` }"
        ></div>
    </div>
</template>

<script>
export default {
    name: "ProgressBar",
    props: {
        value: {
            type: Number,
            default: 0
        }
    },
    computed: {
        // percentageText () {
        //     return `${Math.round(this.value * 100)}%`
        // }
    }
}
</script>

<style scoped>
.progress-bar {
    height: 3px;
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 99;
}

.filled-bar {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    transform: translate3d(-100%, 0, 0);
    z-index: 2;
}
</style>
