<template>
    <Box>
        <template #header>Upload New Images</template>
        <form @submit.prevent="upload">
            <input type="file" multiple @input="addFiles()"/>
            <button type="submit" class="btn-outline">Upload</button>
            <button type="reset" class="btn-outline" @click="reset">Reset</button>
        </form>
    </Box>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3'
    import { sweetAlert } from "../../../Composables/Sweet";
    import Box from '../../../Comonents/UI/Box.vue';

    const props = defineProps(['listing'])

    const form = useForm({
        images: [],
    })

    const reset = () => form.reset('images')

    const addFiles = (event) => {
        for (const image of event.target.files) {
            form.images.push(image)
        }
    }

    function upload() {
        form.post(
            route('realtor.listing.image.store', { listing: props.listing.id }),
            {
                onSuccess: (page) =>{
                    reset,
                    sweetAlert('success',"images added successfully.")
                },
                onError: (errors) => {
                    sweetAlert('error',"An error has occurred.")
                }
            }
        )
    }
</script>