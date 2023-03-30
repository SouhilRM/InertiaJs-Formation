<template>
    <!-- <main-layout></main-layout> plus besoin d'utiliser ca avec les layout -->
    
        
        <div><h1>notre Index.vue</h1></div>
        
        <div>
            <Link href="/show">vers le show</Link>
        </div>

        <div>
            {{ message }}
        </div>

        <div>
            {{ text }}
        </div>
    
</template>

<script setup>
    //pour utiliser les "Link" qui est le fait d'acceder à un lien sans rafrechir la page que propose Inertia faut l'importer
    import { Link } from '@inertiajs/vue3'

    //pour utiliser un component externe faut l'importer et le declarer dans components{}, dans ton script ensuite tu pourras l'utilise dans dans ton template avec <balise-case>
    //import MainLayout from "../Pages/Layouts/MainLayout.vue";

    //pour utiliser la data fournit par laravel via le controller on utilise les "defineProps()"
    defineProps(['message'])
</script>

<script>
//tu importe ici au lieu d'en haut pour pouvoir utiliser "layout" qui n'est diqponible qu'ici
import MainLayout from "../Pages/Layouts/MainLayout.vue";

export default{

    //components:{ MainLayout, },
    
    //utiliser les "layout" au lieu des componentSlotés permet de garder le meme espace temps entre les components qui utilises le meme layout et on l'a démontrer avec l'utilisation des ref-timer dans le MainLayout
    layout: MainLayout,

    data(){
        return{
            text: 'ceci est n text qui vient de la data() de vue'
        }
    }
}
</script>