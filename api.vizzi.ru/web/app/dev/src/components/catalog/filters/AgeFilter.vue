<template>
  <div class="relative">
    <button @click="ageDrop = !ageDrop"
      class="btn-filter-trigger w-[300px]">
      Любой возраст
      <img src="/public/img/icon-arr.svg" alt="">
    </button>
    <div class="drop-item filter-drop mt-4" v-show="ageDrop">
      <div class="flex flex-col items-start max-h-[270px] ml-1 overflow-y-scroll">
        <!-- checkbox -->
        <div class="flex items-center my-1" v-for="age in ages" :key="age">
          <input :id="'age-' + age" type="checkbox" v-model="ageSelect" :value="age" class="w-4 h-4 ml-2 text-main-cyan bg-gray-100 rounded border-gray-300 focus:ring-main-cyan focus:ring-1 focus:ring-opacity-40">
          <label :for="'age-' + age" class="ml-3 text-gray-900 dark:text-gray-300">{{ age }}</label>
        </div>
        <!-- /checkbox -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      ageDrop: false,
      ages: [
        3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18
      ],
      ageSelect: []
    }
  },
  updated() {
     this.$store.commit('SELECT_AGE', this.ageSelect);
    
  },
  mounted() {
     this.ageSelect = this.$store.state.filter.ages
  },
}
</script>

<style>

</style>