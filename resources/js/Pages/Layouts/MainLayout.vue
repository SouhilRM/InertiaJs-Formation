<template>

    <Link href="/">INDEX</Link>&nbsp;
    <Link href="/show">SHOW</Link>
    
    <h2>{{ timer }}</h2>

    <header>
        <slot name="header"><h1>header par defaut</h1></slot>
    </header>

    <div>
        <slot></slot>
    </div>
    
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'

    //ref permet de declarer un timer
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