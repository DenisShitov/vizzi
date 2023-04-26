<template>
    <div class="camp-card w-[48%] min-w-[280px] max-w-[400px] flex-initial bg-white rounded-xl overflow-hidden shrink flex flex-col">
        <Splide :options="{
            type: 'slide',
            height: 200,
            pagination: true,
            arrows: false,
            rewindByDrag: true
            }">
            <SplideSlide v-for="img in imgArr" :key="img">
                <img :src='"https://picsum.photos/500/300?random=" + camp.id' alt="camp">
            </SplideSlide>
        </Splide> 

        <div class="card-info px-4 pb-4 grow">
            <div class="card-name flex mb-1 ">
                <h3 class="card-title font-semibold mr-5">{{ camp.c_name }}</h3>
            </div>
            <div class="card-rating flex">
                <rating-render :rating="camp.c_category"/>
            </div>
            <div class="card-address gap-4 mb-2">
                <div class="float-right flex gap-2">
                    <img src="/img/icon-age.svg" alt="age">{{ camp.c_age_from }}-{{ camp.c_age_to }} лет
                </div>
                <p class=" text-cyan-700">
                    <img class="inline mr-2" src="/img/icon-map.svg" alt="map">{{ camp.c_address }}
                </p>
            </div>
            <p class="card-description max-h-[80px] overflow-hidden text-ellipsis mb-1 text-sm text-gray-500">{{ camp.c_desc }}</p>
            <p class="card-transport mb-1"><strong>Трансфер: </strong>{{ transportType(camp.c_transfer) }}</p>
            <p class="card-meal mb-3"><strong>Питание: </strong>{{ camp.meal }} разовое</p>
            <div class="tag-list flex flex-wrap gap-2">
                <camp-tag v-for="tag in campTags" :key="tag.id" :tag="tag"/>
            </div>
        </div>

        <div class="card-bottom p-4 bg-main-cyan w-full object-bottom flex items-center justify-between">
            <div class="flex flex-col">
                <div div class="card-price flex items-center gap-3">
                    <h4 class="card-newprice text-2xl">{{ costDivider(camp.c_cost) }} ₽</h4>
                    <h5 class="card-oldprice line-through opacity-50">{{ costDivider(camp.c_cost) }} ₽</h5>
                </div>
                <p class="card-interval ">за {{ camp.c_duration }} дней</p>
            </div>
            <router-link :to="{ name: 'CampPage', params: { id: `${this.camp.id}` }}"> 
                <p class="text-lg">Подробнее</p>
            </router-link>
        </div>
        <p></p>
    </div>
</template>

<script>
import axios from "axios"
import RatingRender from '@/components/common/RatingRender.vue'
import CampTag from '@/components/catalog/common/CampTag.vue'
export default {
    components: {
        RatingRender,
        CampTag
    },
    props: {
        camp: {
            type: Object
        }
    },
    data() {
        return {
            imgArr: [1,2,3],
            campTags: [],
            img: '',
        }
    },
    methods: {
        costDivider(value) {
             return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        },
        transportType(value) {
            let str = '';
            switch (value) {
                case 1 :
                    str = 'авиа';
                    break;
                case 2 :
                    str = 'автобус';
                    break;
                case 3 :
                    str = 'ж/д';
                    break;
                case 4 :
                    str = 'самостоятельно';
                    break;
            }
                return str;

        },
    },
    filters: {
        
    },
    mounted() {
        this.campTags = this.camp.c_tags.replace(/[^a-zа-яё\,]/g, '').split(',');
    },
    
    

}
</script>

<style>
</style>