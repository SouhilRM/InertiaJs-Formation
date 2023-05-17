<template>

    <Link :href="route('index')">INDEX</Link>&nbsp;
    <Link :href="route('index.show')">SHOW</Link>&nbsp;
    <Link :href="route('listing.index')">indexlisting</Link>&nbsp;
    <Link :href="route('listing.create')">Create Listing</Link>

    <h2>{{ timer }}</h2>

    <header>
        <h1>ceci est un text qui provient du layout</h1>
    </header>

    <div>
        <slot></slot>
    </div>
    
</template>

<script setup>
    import { Link, usePage } from '@inertiajs/vue3'
    import { computed } from 'vue'

    //"ref" permet de declarer un truc en temps reel (variable, nombre, chaine de cra, PAS UN OBJET) ideal pour le temps
    import { ref } from "vue";
    const timer = ref(0)
    setInterval(()=> timer.value++, 1000)

</script>

<style scoped>
    header{
        color: red;
    }
    div {
        margin: 2rem auto;
        max-width: 30rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
        padding: 1rem;
    }
</style>
