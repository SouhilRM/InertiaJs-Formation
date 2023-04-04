<template>

    <Link href="/">INDEX</Link>&nbsp;
    <Link href="/show">SHOW</Link>&nbsp;
    <Link href="/index">indexlisting</Link>&nbsp;
    <Link href="/create">Create Listing</Link>

    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>    
    
    <h2>{{ timer }}</h2>

    <header>
        <slot name="header"><h1>header par defaut</h1></slot>
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

    //pour itiliser les sharing data t'as besoin du 'usePage' noublie pas de l'ipmorter 
    //on a aussi importer le 'computed' depuis vue juste pour ne pas ecrire une grosse expression à chaque fois que t'as une expression enorme avec de la logique utilise 'computed' comme vue et declare ta logique dans une fonction que tu pourras utiliser plus tard.
    const flashSuccess = computed(
        () => usePage().props.flash.success,
    )
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
    .success {
        background-color: green;
        color: white;
    }
</style>
