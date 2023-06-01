<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
      <Listing v-for="listing in listings.data" :key="listing.id" :can="can" :listing="listing"></Listing>
    </div>

    <!-- le "links" ici c'est un attribut de l'objet listings qu'on a passé grace à la pagination via le controlleur, attention il ne s'agit pas du "Link" de inertia -->
    <div v-if="listings.data.length" class="w-full flex justify-center mt-8 mb-8">
      <Pagination :links="listings.links" />
    </div>
  </template>

<script setup>
  import Pagination from '../../Comonents/UI/Pagination.vue';
  import Listing from './Index/Components/Listing.vue';

  defineProps({listings: Object, can: [Object,Boolean]})
</script>