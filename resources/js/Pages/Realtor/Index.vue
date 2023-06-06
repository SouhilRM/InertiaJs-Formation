<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>

    <section>
        <RealtorFilters :filters="filters"></RealtorFilters>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings" :key="listing.id">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div>
                    <div class="xl:flex items-center gap-2">
                    <Price :price="listing.price" class="text-2xl font-medium" />
                    <ListingSpace :listing="listing" />
                    </div>

                    <ListingAddress :listing="listing" />
                </div>
                
                <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                    <!-- <Link class="btn-outline text-xs font-medium">Preview</Link>
                    <Link class="btn-outline text-xs font-medium">Edit</Link> -->
                    <button class="btn-outline text-xs font-medium" @click="confirmationDelete(listing.id)">Delete</button>
                </div>
            </div>
        </Box>
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

    defineProps({
        listings: Array,
        filters: Object,
    })

    const confirmationDelete = (id)=>{
        sweetConfirm("Are you sure you want to remove this listing ?",()=>deleteListing(id))
    }

    const deleteListing = (id)=>{
        router.delete(
            route('realtor.listin.delete', {listing: id}),
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
</script>