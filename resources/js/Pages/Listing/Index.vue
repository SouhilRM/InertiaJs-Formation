<template>
    <h1>coucou</h1>
    <div v-for="listing in listings" :key="listing.id">
        <!-- l'utilisation des baktips est primordiale `` -->
        <Link :href="`/listingShow/${ listing.id }`">
            {{ listing.city }}
        </Link>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'
    defineProps(['listings'])
</script>

<script>
import MainLayout from "../Layouts/MainLayout.vue";

export default{
    layout: MainLayout,
}
</script>