<template>
    <h1>coucou</h1>
    <div v-for="listing in listings" :key="listing.id">

        <div>

            <!-- l'utilisation des baktips est primordiale `` -->

            <Link :href="`/listingShow/${ listing.id }`">

                {{ listing.city }} &nbsp; &nbsp;

                <Link :href="`/listingEdit/${ listing.id }`">EDIT</Link> &nbsp; &nbsp;

                <Link :href="`/listingDelete/${ listing.id }`" method="DELETE">DELETE</Link>

            </Link>

        </div><br>

    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'
    defineProps(['listings'])
</script>