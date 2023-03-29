<template>
    <main-layout>
        <template #default>
            <div>
                <h1>notre Show.vue</h1>
            </div>

            <div>
                <Link href="/">vers l'index</Link>
            </div>
        </template>
    </main-layout>  
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'
    import MainLayout from "../Pages/Layouts/MainLayout.vue";
</script>