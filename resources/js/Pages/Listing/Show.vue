<template>
    <div class="flex flex-col-reverse md:grid grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center w-full">
            <div class="w-full text-center font-medium text-gray-500">
                No Images
            </div>
        </Box>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box class="md:col-span-5">
                <template #header>
                    Basic infos
                </template>

                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>
            <Box>
                <template #header>
                    Offer
                </template>
                Make an Offer
            </Box>
        </div>
    </div>
</template>

<script setup>
    import ListingAddress from '../../Comonents/ListingAddress.vue';
    import ListingSpace from '../../Comonents/ListingSpace.vue';
    import Price from '../../Comonents/Price.vue';
    import Box from '../../Comonents/UI/Box.vue';

    defineProps(['listing'])
</script>