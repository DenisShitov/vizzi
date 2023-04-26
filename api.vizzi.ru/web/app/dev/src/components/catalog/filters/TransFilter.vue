<template>
  <div class="mb-4">
      <p class="filter-title font-medium mb-3">Трансфер</p>
      <div class="columns-2">
        <div class="flex items-center mb-1" v-for="transport in transportType" :key="transport.type">
          <input :id="transport.type" type="checkbox" v-model="transportSelect" :value="transport.type" class="w-4 h-4 ml-2 text-main-cyan bg-gray-100 rounded border-gray-300 focus:ring-main-cyan focus:ring-1 focus:ring-opacity-40">
          <label :for="transport.type" class="ml-3 text-gray-900 dark:text-gray-300">{{ transport.name }}</label>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      transportType: [
        {type:'1', name:'Авиа'},
        {type:'2', name:'Автобус'},
        {type:'3', name:'Ж/Д'},
        {type:'4', name:'Самостоятельно'},

      ],
      transportSelect: []
    }
  },
  updated() {
     this.$store.dispatch('selectTransport', this.transportSelect);
  },
  mounted() {
     this.transportSelect = this.$store.state.filter.transport
  },
}
</script>

<style>

</style>