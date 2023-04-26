<template>
    <section class="catalog-main bg-background pb-6">
        <div class="container">
            <div class="breadcrumbs flex  py-5">
            Главная
            /
            Каталог лагерей
            </div>
            

            <div class="catalog-inner flex gap-7">
                <div class="catalog-left-side w-[370px]">
                    <h1 class="title mb-12 text-3xl font-semibold">Каталог лагерей</h1>
                    <camp-filter/>
                </div>
                <div class="catalog-right-side flex-initial min-w-[50%]">
                    <div class="flex gap-2 mb-6">
                        <input @keyup.enter="filterByName" type="text" placeholder="Поиск по наименованию лагеря" v-model="campName" class="w-full rounded-xl border-gray-300 mr-[-30px]">
                        <button class="btn-main" @click="filterByName">Искать</button>
                    </div>
                    <div class="catalog-sort mb-4 flex justify-end items-center gap-2">
                        <button
                            @click="toHorizontalView"
                        ><img src="@/../public/img/icon-sort-h.svg" width="26" height="26"  alt="icon-sort-h"></button>
                        <button
                            @click="toCompactView"
                        ><img src="/public/img/icon-sort-v.svg" width="26" height="26"  alt="icon-sort-v"></button>
                        <!-- <button
                            class="border-2 rounded-xl border-gray-300 py-2 px-4 ml-4 bg-white flex items-center justify-between w-[300px]">
                            От дешевых к дорогим
                            <img src="/public/img/icon-arr.svg" alt="">
                        </button> -->
                        <select class="rounded-lg border-gray-300">
                            <option>По алфавиту </option>
                            <option>По цене (по возрастанию) </option>
                            <option>По цене (по убыванию)</option>
                            <option>По возрасту (по возрастанию) </option>
                            <option>По возрасту (по убыванию)</option>
                            <option>По рейтингу (по возрастанию) </option>
                            <option>По рейтингу (по убыванию)</option>
                        </select>
                    </div>
                    <camp-list :camps="camps" :cardHorizontal="cardHorizontal" />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import BtnLogin from '@/components/header/BtnLogin.vue'
import BtnCashback from '@/components/header/BtnCashback.vue'
import CampCard from '@/components/catalog/СampCard.vue'
import CampFilter from '@/components/catalog/СampFilter.vue'
import CampList from '@/components/catalog/СampList.vue'
import axios from 'axios'

export default {
    components: {
        BtnLogin, BtnCashback, CampCard, CampFilter, CampList
    },
    data() {
        return {
            cardHorizontal: false,
            campName: '',
        }
    },
    computed: {
        filterByName() {
            this.$store.commit('FILTER_CAMPS_BY_NAME', this.campName)
        },
    },
    methods: {
        toHorizontalView() {
            this.cardHorizontal = true
        },
        toCompactView() {
            this.cardHorizontal = false
        }
    },
    mounted() {
        this.$store.commit('FILTER_CAMPS_BY_CHECKBOX')
    },
    updated() {
        this.$store.dispatch('typeName', this.campName);
    }
}
</script>

<style>
</style>