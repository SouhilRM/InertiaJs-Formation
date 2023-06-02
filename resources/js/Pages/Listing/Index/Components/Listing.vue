<template>
    <Box>
        <div>
        <Link
            :href="route('listing.show', {listing: listing.id})"
        >
            <div class="flex items-center gap-1">
            <Price
                :price="listing.price"
                class="text-2xl font-bold"
            />
            <div class="text-xs text-gray-500">
                <Price :price="monthlyPayment" /> pm
            </div>
            </div>
            <ListingSpace :listing="listing" class="text-lg" />
            <ListingAddress
            :listing="listing"
            class="text-gray-500"
            />
        </Link>
        </div>
        <div>
        <Link v-if="authorizationDisplay(can, listing.by_user_id)" :href="route('listing.edit', {listing: listing.id})">
            Edit
        </Link>
        </div>
        <div>
        <button v-if="authorizationDisplay(can, listing.by_user_id)" @click="confirmationDelete(listing.id)">
            Delete
        </button>
        </div>
    </Box>
</template>

<script setup>
    
    import { Link,router } from '@inertiajs/vue3'

    import { useMonthlyPayment } from '../../../../Composables/useMonthlyPayment'
    import { sweetConfirm,sweetAlert } from "../../../../Composables/Sweet"
    
    import ListingAddress from '../../../../Comonents/ListingAddress.vue'
    import Box from '../../../../Comonents/UI/Box.vue'
    import ListingSpace from '../../../../Comonents/ListingSpace.vue'
    import Price from '../../../../Comonents/Price.vue'
    
    const props = defineProps({listing: Object, can: [Object,Boolean]})

    const authorizationDisplay = (user, listing_by_user_id) => {
        return ( user.is_admin === 1 || user.id === listing_by_user_id )
    }

    const { monthlyPayment } = useMonthlyPayment(
        props.listing.price, 2.5, 25,
    )

    const confirmationDelete = (id)=>{
        sweetConfirm("Etes-vous sur de vouloir retirer cet étudiant ?",()=>deleteEtudiant(id))
    }

    const deleteEtudiant = (id)=>{
        router.delete(
            route('listing.delete', {listing: id}),
            {
                onSuccess: (page) =>{
                    console.log('ca marche !!');
                    sweetAlert('success',"Etudiant retiré avec succès.")
                },

                onError: (errors) => {
                    //console.log(errors);
                    sweetAlert('error',errors.message)
                }
            }
        )
    }
</script>