<template>
    <main-layout>
        <template #header>
            <div><h1>notre Index.vue</h1></div>
        </template>

        <div>
            <Link href="/show">vers le show</Link>
        </div>

        <div>
            {{ message }}
        </div>

        <div>
            {{ text }}
        </div>
    </main-layout>
</template>

<script setup>
    //pour utiliser les "Link" qui est le fait d'acceder à un lien sans rafrechir la page que propose Inertia faut l'importer
    import { Link } from '@inertiajs/vue3'

    //pour utiliser un component externe faut l'importer et le declarer dans components{}, dans ton script ensuite tu pourras l'utilise dans dans ton template avec <balise-case>
    import MainLayout from "../Pages/Layouts/MainLayout.vue";

    //pour utiliser la data fournit par laravel via le controller on utilise les "defineProps()"
    defineProps(['message'])
</script>

<script>
export default{

    components:{
        MainLayout,
    },

    data(){
        return{
            text: 'ceci est n text qui vient de la data() de vue'
        }
    }
}
</script>