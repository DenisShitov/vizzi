<template>
  <div class="mb-4">
      <p class="filter-title font-medium mb-3">Тип лагеря</p>
      <div class="flex flex-col items-start">
        <div class="flex items-center mb-1" v-for="category in categoryType" :key="category.type">
          <input :id="category.type" type="checkbox" v-model="categorySelect" :value="category.type" class="w-4 h-4 ml-2 text-main-cyan bg-gray-100 rounded border-gray-300 focus:ring-main-cyan focus:ring-1 focus:ring-opacity-40">
          <label :for="category.type" class="ml-3 text-gray-900 dark:text-gray-300">{{ category.name }}</label>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      categoryType: [
        {type:'1', name:'Тематические'},
        {type:'2', name:'Развивающие'},
        {type:'3', name:'Спортивные'},
        {type:'4', name:'Оздоровительные'},

      ],
      categorySelect: []
    }
  },
  updated() {
     this.$store.dispatch('selectCategory', this.categorySelect);
  },
  mounted() {
     this.categorySelect = this.$store.state.filter.category
  },
}
</script>

<style>

</style>