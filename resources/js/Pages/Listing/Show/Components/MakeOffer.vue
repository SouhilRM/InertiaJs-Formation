<template>
    <Box>
        <template #header>Make an Offer</template>
        <div>
            <form @submit.prevent="makeOffer">
                <input v-model.number="form.amount" type="text" class="input" />
                <input
                    v-model.number="form.amount"
                    type="range" :min="min"
                    :max="max" step="1000"
                    class="mt-2 w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                />

                <button type="submit" class="btn-outline w-full mt-2 text-sm">
                    Make an Offer
                </button>
                <div class="input-error">
                    {{ form.errors.amount }}
                </div>
                
            </form>
        </div>
        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference</div>
            <div>
                <Price :price="difference" />
            </div>
        </div>
    </Box>
</template>

<script setup>
    
    import { useForm } from '@inertiajs/vue3'
    import { computed, watch } from 'vue'
    import { sweetAlert } from "../../../../Composables/Sweet";
    import { debounce } from 'lodash'

    import Box from '../../../../Comonents/UI/Box.vue';
    import Price from '../../../../Comonents/Price.vue';

    const props = defineProps({
        listingId: Number,
        price: Number,
    })

    const form = useForm({
        amount: props.price,
    })

    const min = computed(() => Math.round(props.price / 2))
    const max = computed(() => Math.round(props.price * 2))

    const difference = computed(() => form.amount - props.price)

    const makeOffer = () => form.post(
        route('listing.offer.store', { listing: props.listingId }),
        {
            onSuccess: (page) =>{
                sweetAlert('success',"your offer has been sent successfully.")
            },
            onError: (errors) => {
                sweetAlert('error',"An error has occurred.")
            }
        }
    )

    const emit = defineEmits(['offerUpdated'])

    watch(
        ()=>form.amount, 
        debounce(
            (value)=>emit('offerUpdated',value),
            200
        )
    )
    
</script>