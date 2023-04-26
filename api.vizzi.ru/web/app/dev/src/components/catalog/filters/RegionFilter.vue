<template>
  <div class="relative">
    <button @click="regionDrop = !regionDrop"
      class="btn-filter-trigger w-[300px]">
      Любой регион
      <img src="/public/img/icon-arr.svg" alt="">
    </button>
    <div class="drop-item filter-drop mt-4 " v-show="regionDrop">
      <div class="drop-search">
        <img src="/public/img/icon-search.svg" class="inline mx-2" alt="search" width="16" height="16">
        <input type="text" placeholder="Введите регион..."
          class=" mb-2 p-0 border-0 placeholder:italic placeholder:text-sm" v-model="regionInput"
          @input="regionFiltering">
      </div>
      <div class="flex flex-col items-start max-h-[270px] ml-1 overflow-y-scroll">
        <!-- checkbox -->
        <div class="flex items-center my-1" v-for="region in regionsFiltered" :key="region.id">
          <input :id="region.id" type="checkbox" v-model="regionsSelect" @click="regionValue" :value="region.id" class="w-4 h-4 ml-2 text-main-cyan bg-gray-100 rounded border-gray-300 focus:ring-main-cyan focus:ring-1 focus:ring-opacity-40">
          <label :for="region.id" class="ml-3 text-gray-900 dark:text-gray-300">{{ region.name }}</label>
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
      regionDrop: false,
      regionInput: '',
      regionsSelect: [],
      regionsFiltered: [],
      regions: this.$store.state.regions
    }
  },
  mounted() {
    this.regionsFiltered = this.regions;
    this.regionInput = this.$store.state.filter.region;
  },
  updated() {
     this.$store.dispatch('selectRegion', this.regionsSelect);
  },
  computed: {
    regionFiltering() {
      this.regionsFiltered = this.regions.filter(item => {
        item = item.name.toUpperCase();
        let str = this.regionInput.toUpperCase();
        return item.includes(str);
      });
    }
  }
}
</script>

<style>
</style>