<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
      <Listing v-for="listing in listings" :key="listing.id" :can="can" :listing="listing"></Listing>
    </div>
  </template>

<script setup>
    import Listing from './Index/Components/Listing.vue';
    defineProps({listings: Object, can: [Object,Boolean]})
</script>