<template>
    <div>you need be verifid first to visit this page !!</div>
    <div>
        <Link :href="route('verification.send')" method="post" as="button" class="text-indigo-600">Resend Verification Email</Link>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'
</script>