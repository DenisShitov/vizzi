<template>
  <div class="catalog-filter bg-white w-full rounded-xl p-7 shadow-sm top-20">
    <div div class="mb-4">
      <p class="filter-title font-medium mb-3">Регион</p>
      <region-filter/>
    </div>
    <!-- <div class="mb-4">
      <p class="filter-title font-medium mb-3">Выезд из</p>
      <button class="border-2 rounded-xl border-gray-300 py-2 px-4 flex items-center justify-between w-[300px]">
        Любой регион
        <img src="/public/img/icon-arr.svg" alt="">
      </button>
    </div> -->
    <div div class="mb-4">
      <p class="filter-title font-medium mb-3">Возраст ребенка</p>
      <age-filter/>
    </div>
  

  <trans-filter/>

  <category-filter/>

    <!-- <div class="mb-4">
      <p class="filter-title font-medium mb-3">Длительность смены</p>
      <button class="border-2 rounded-xl border-gray-300 py-2 px-4 flex items-center justify-between w-[300px] mb-4">
        Любая длительность
        <img src="/public/img/icon-arr.svg" alt="">
      </button>
    </div>

    <div class="mb-4">
      <p class="filter-title font-medium mb-3">Бюджет</p>
      <button class="border-2 rounded-xl border-gray-300 py-2 px-4 flex items-center justify-between w-[300px] mb-4">
        Любой бюджет
        <img src="/public/img/icon-arr.svg" alt="">
      </button>
    </div>

    <div class="mb-4">
      <p class="filter-title font-medium mb-3">Трансфер</p>
      <div class="columns-2">
        <div class="flex flex-col items-start">
          <button class="check-filter active">Зима</button>
          <button class="check-filter">Весна</button>
        </div>
        <div class="flex flex-col items-start">
          <button class="check-filter">Лето</button>
          <button class="check-filter">Осень</button>
        </div>
      </div>
    </div>

    <div class="mb-4">
      <p class="filter-title font-medium mb-3">Хобби и спорт</p>
      <button class="border-2 rounded-xl border-gray-300 py-2 px-4 flex items-center justify-between w-[300px] mb-4">
        Выбрать хобби
        <img src="/public/img/icon-arr.svg" alt="">
      </button>
    </div>

    <div class="mb-4">
      <p class="filter-title font-medium mb-3">Наличие бассейна</p>
      <div class="columns-2">
        <div class="flex flex-col items-start">
          <button class="check-filter active">Да</button>
        </div>
        <div class="flex flex-col items-start">
          <button class="check-filter">Нет</button>
        </div>
      </div>
    </div>

    <div class="mb-4">
      <p class="filter-title font-medium mb-3">Удобство в номере</p>
      <div class="columns-2">
        <div class="flex flex-col items-start">
          <button class="check-filter active">Wi-Fi</button>
          <button class="check-filter">Кондиционер</button>
        </div>
        <div class="flex flex-col items-start">
          <button class="check-filter active">Холодильник</button>
          <button class="check-filter active">Телевизор</button>
        </div>
      </div>
    </div>

    <div class="mb-4">
      <p class="filter-title font-medium mb-3">Размещение в номере</p>
      <div class="columns-2">
        <div class="flex flex-col items-start">
          <button class="check-filter ">2-х</button>
          <button class="check-filter">3-х</button>
        </div>
        <div class="flex flex-col items-start">
          <button class="check-filter active">4-х</button>
          <button class="check-filter ">5-ти</button>
        </div>
      </div>
    </div>

    <div class="mb-4">
      <p class="filter-title font-medium mb-3">Для людей с огранич. возможностями</p>
      <div class="columns-2">
        <div class="flex flex-col items-start">
          <button class="check-filter active">Да</button>
        </div>
        <div class="flex flex-col items-start">
          <button class="check-filter">Нет</button>
        </div>
      </div>
    </div>

    <div class="mb-4">
      <p class="filter-title font-medium mb-3">Расположение</p>
      <div class="flex flex-col items-start">
        <button class="check-filter">Город</button>
        <button class="check-filter">Море</button>
        <button class="check-filter">Природа</button>
        <button class="check-filter">Лес</button>
        <button class="check-filter">Горы</button>
      </div>
    </div>

    <div class="mb-4">
      <p class="filter-title font-medium mb-3">Скидки и акциии</p>
      <div class="flex flex-col items-start">
        <button class="check-filter flex items-center">Показать только с кэшбэком</button>
        <button class="check-filter">Лагеря со скидками</button>
      </div>
    </div> -->

    <button class="btn-main my-7 w-full" @click="searchCamps">Искать</button>

    <a href="#" @click.prevent="resetCamps" class="block w-full text-center text-gray-400 underline underline-offset-2 hover:opacity-75 ">Сбросить
      настройки</a>
  </div>
</template>

<script>
import RegionFilter from '@/components/catalog/filters/RegionFilter.vue'
import CheckboxFilter from '@/components/catalog/common/CheckboxFilter.vue'
import TransFilter from '@/components/catalog/filters/TransFilter.vue'
import AgeFilter from '@/components/catalog/filters/AgeFilter.vue'
import CategoryFilter from '@/components/catalog/filters/CategoryFilter.vue'

export default {
  components: {
    RegionFilter,
    TransFilter,
    AgeFilter,
    CheckboxFilter,
    CategoryFilter
},
data() {
  return {
    dropItems: {
      regionDrop: false,
      transportDrop: false,
      ageDrop: false,
      shiftDrop: false,
      budgetDrop: false,
      hobbyDrop: false,
    },
  }
},
computed: {
  searchCamps() {
    this.$store.commit('FILTER_CAMPS_BY_CHECKBOX');
  },
  resetCamps() {
    this.$store.commit('FILTER_RESET');
  }
}

}

</script>

<style>
</style>