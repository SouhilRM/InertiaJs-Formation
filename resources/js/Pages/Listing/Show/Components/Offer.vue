<template>
    <!-- <div>{{ offer.bidder }}</div> -->
    <Box>
        <template #header>
            Offer #{{ offer.id }} 
            <span v-if="offer.accepted_at" class="dark:bg-green-900 bg-green-200 text-green-900 p-1 rounded-md uppercase ml-1">
                accepeted
            </span>
        </template>

        <section class="flex items-center justify-between">
            <div>
                <Price :price="offer.amount" class="text-xl" />

                <div class="text-gray-500">
                    Difference <Price :price="difference" />
                </div>

                <div class="text-gray-500 text-sm">
                    Made by {{ offer.bidder.name }}
                </div>

                <div class="text-gray-500 text-sm">
                    Made on {{ madeOn }}
                </div>
            </div>
            <div>
                <button v-if="notSold" class="btn-outline text-xs font-medium" @click="Accept(offer.id)">
                    Accept
                </button>
            </div>
        </section>
    </Box>
</template>

<script setup>
    
    import { router } from '@inertiajs/vue3'
    import { computed } from 'vue'
    import { sweetAlert } from "../../../../Composables/Sweet";

    import Price from '../../../../Comonents/Price.vue';
    import Box from '../../../../Comonents/UI/Box.vue';

    const props = defineProps({
        offer: Object,
        listingPrice: Number,
    })
    const difference = computed(
        () => props.offer.amount - props.listingPrice,
    )
    const madeOn = computed(
        () => new Date(props.offer.created_at).toDateString(),
    )

    const Accept = (id) => {
        router.visit(
            route('offer.accept', id),
            {
                method: 'put',
                onSuccess: () => {
                    sweetAlert('success',"Offer accepted successfully.")
                },
                onError: (errors) => {
                    sweetAlert('error',"An error has occurred.")
                }
            }
        )
    }

    const notSold = computed(
        () => !props.offer.accepted_at && !props.offer.rejected_at,
    )
</script>