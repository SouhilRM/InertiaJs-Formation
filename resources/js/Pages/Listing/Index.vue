<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
      <Box v-for="listing in listings" :key="listing.id">

        <div>
          <Link :href="route('listing.show', {listing: listing.id})">
            <Price :price="listing.price" class="text-2xl font-bold" />
            <ListingSpace :listing="listing" class="text-lg" />
            <ListingAddress :listing="listing" class="text-gray-500" />
          </Link>
        </div>

        <div>
          <Link :href="route('listing.edit', {listing: listing.id})">
            Edit
          </Link>
        </div>

        <div>
          <Link :href="route('listing.delete', {listing: listing.id})" method="DELETE">
            Delete
          </Link>
        </div>

      </Box>
    </div>
  </template>

<script setup>
    import Box from '../../Comonents/UI/Box.vue';
    import ListingAddress from '../../Comonents/ListingAddress.vue'
    import ListingSpace from '../../Comonents/ListingSpace.vue'
    import Price from '../../Comonents/Price.vue'

    import { Link } from '@inertiajs/vue3'
    defineProps(['listings'])
    
</script>