<template>
    <!-- <main-layout></main-layout> plus besoin d'utiliser ca avec les layout -->
    
        
        <div><h1 class="text-3xl font-bold underline">notre Index.vue</h1></div>
        
        <div>
            <Link href="/show">vers le show</Link>
        </div>

        <div>
            {{ message }}
        </div>
    
</template>

<script setup>
    //pour utiliser les "Link" qui est le fait d'acceder à un lien sans rafrechir la page que propose Inertia faut l'importer
    import { Link } from '@inertiajs/vue3'

    //pour utiliser la data fournit par laravel via le controller on utilise les "defineProps()"
    defineProps(['message'])
</script>