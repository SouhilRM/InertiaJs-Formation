<template>
    <div>
        {{ listing.street }} =====> {{ listing.price }}$
    </div>
</template>

<script setup>
    defineProps(['listing'])
</script>

<script>
import MainLayout from "../Layouts/MainLayout.vue";

export default{
    layout: MainLayout,
}
</script>