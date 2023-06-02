<template>
    <div class="flex gap-1">
        <!--
            Remarques : 
            -dans la boucle v-for on a rajouter l'index car on avait besoin d'un unique pour le mettre dans key
            -"Link" c'est les lien d'Inertia; et "links" c'est c'est l'attribut de l'objet listings qu'on a passé dnas les props
            -v-html="link.label" permet juste de cacher  l'html qui a été generé et de ne garder que le label
            -la condition qu'on a mis dans notre :href est là pour eviter le bug de l'url null qui surviens surtout lorceque le "Next" et le "Previous" de la pagination sont au bout des pages
        -->
        <Link
            v-for="(link, index) in links" :key="index" 
            class="py-2 px-4 rounded-md" 
            :href="link.url ? link.url : ''" 
            :class="{'bg-indigo-500 text-gray-300': link.active}"
            v-html="link.label"
        />
    </div>
</template>

<script setup>
    import {Link} from '@inertiajs/vue3'
    defineProps({links: Array})
</script>