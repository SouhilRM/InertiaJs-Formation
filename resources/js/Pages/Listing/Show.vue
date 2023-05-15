<template>
    <div>
        {{ listing.street }} =====> {{ listing.price }}$
    </div>
</template>

<script setup>
    defineProps(['listing'])
</script>