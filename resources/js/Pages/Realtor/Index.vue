<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>

    <section>
        <RealtorFilters :filters="filters"></RealtorFilters>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings.data" :key="listing.id" :class="{ 'border-dashed': listing.deleted_at }">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div :class="{ 'opacity-25': listing.deleted_at }">

                    <div
                        v-if="listing.sold_at != null" 
                        class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 dark:border-green-600 dark:text-green-600 inline-block rounded-md mb-2"
                    >
                        sold
                    </div>

                    <div class="xl:flex items-center gap-2">
                        <Price :price="listing.price" class="text-2xl font-medium" />
                        <ListingSpace :listing="listing" />
                    </div>

                    <ListingAddress :listing="listing" />
                </div>
                <section>
                    <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                        <a
                            v-if="!listing.deleted_at"
                            class="btn-outline text-xs font-medium" 
                            :href="route('listing.show', { listing: listing.id })"
                            target="_blank"
                        >Preview</a>

                        <Link 
                            v-if="!listing.deleted_at" 
                            class="btn-outline text-xs font-medium" 
                            :href="route('realtor.listing.edit', { listing: listing.id })"
                        >Edit</Link>

                        <button
                            v-if="!listing.deleted_at" 
                            class="btn-outline text-xs font-medium" 
                            @click="confirmationDelete(listing.id)"
                        >Delete</button>

                        <button
                            v-if="listing.deleted_at"
                            class="btn-outline text-xs font-medium"  
                            @click="notif(listing.id)"
                        >Restore</button>
                    </div>

                    <div class="mt-2">
                        <Link :href="route('realtor.listing.image.create', { listing: listing.id })" class="block w-full btn-outline text-xs font-medium text-center">Images ({{ listing.images_count }})</Link>
                    </div>

                    <div class="mt-2">
                        <Link
                        :href="route('listing.offer.show', { listing: listing.id })"
                        class="block w-full btn-outline text-xs font-medium text-center"
                        >
                        Offers ({{ listing.offers_count }})
                        </Link>
                    </div>
                </section>
            </div>
        </Box>
    </section>

    <section v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
        <Pagination :links="listings.links" />
    </section>
</template>

<script setup>
    
    import { Link,router } from '@inertiajs/vue3'
    import { sweetConfirm,sweetAlert } from "../../Composables/Sweet"

    import ListingAddress from '../../Comonents/ListingAddress.vue'
    import ListingSpace from '../../Comonents/ListingSpace.vue'
    import Price from '../../Comonents/Price.vue'
    import Box from '../../Comonents/UI/Box.vue'
    import RealtorFilters from './Index/Components/RealtorFilters.vue';
    import Pagination from '../../Comonents/UI/Pagination.vue'

    defineProps({
        listings: Object,
        filters: Object,
    })

    const confirmationDelete = (id)=>{
        sweetConfirm("Are you sure you want to remove this listing ?",()=>deleteListing(id))
    }

    const deleteListing = (id)=>{
        router.delete(
            route('realtor.listing.delete', {listing: id}),
            {
                onSuccess: (page) =>{
                    sweetAlert('success',"listing moved to trash successfully.")
                },

                onError: (errors) => {
                    console.log(errors);
                    sweetAlert('error',errors.message)
                }
            }
        )
    }

    const notif = (id)=>{
        router.visit(
            route('realtor.listing.restore', id),
            {
                method: 'put',
                onSuccess: () => {
                    sweetAlert('success',"Listing successfully restored.")
                },
                onError: (errors) => {
                    sweetAlert('error',"An error has occurred.")
                }
            }
        )
    }
</script>