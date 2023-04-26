<template>
        <div class="rating w-[92px] h-4 mb-3 relative">
            <div class="rating-bg bg-gray-300 h-full w-full absolute top-0 left-0"></div>
            <div class="rating-line bg-text-main h-full absolute top-0 left-0" :style="{width: lineWidth + '%'}"></div>
            <div class="rating-mask bg-[url('/public/img/stars-mask.png')] bg-cover h-full w-full absolute top-0 left-0"></div>
        </div>

</template>

<script>
export default {
    props: {
        rating: Number,
    },
    data() {
        return {
            lineWidth: 0,
        }
    },
    mounted() {
        this.ratingToWidth()
    },
    methods: {
        ratingToWidth() {
            let rate = this.rating.toFixed(1);
            this.lineWidth = rate*20;
        }
    },
}
</script>

<style>
</style>