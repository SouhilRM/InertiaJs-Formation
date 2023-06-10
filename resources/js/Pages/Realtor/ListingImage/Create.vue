<template>
    <Box>
        <template #header>Upload New Images</template>
        <form @submit.prevent="upload">
            <section class="flex items-center gap-2 my-4">
                <input
                class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
                type="file" multiple @input="addFiles"
                />
                <!-- <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress> -->
                
                <button
                type="submit"
                class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
                :disabled="!canUpload"
                >
                Upload</button>

                <button
                type="reset" class="btn-outline"
                @click="reset"
                >
                Reset</button>
            </section>
            <div v-if="imageErrors" class="input-error">
                <div v-for="(error, index) in imageErrors" :key="index">
                    {{ error }}
                </div>
            </div>
        </form>
    </Box>
    
    <Box v-if="listing.images.length" class="mt-4">
        <template #header>Current Listing Images</template>
        <section class="mt-4 grid grid-cols-3 gap-4">
            <div v-for="image in listing.images" :key="image.id" class="flex flex-col justify-between">
                <img :src="'/storage/'+image.filename" class="rounded-md"/>

                <!-- <button
                    @click="deleteImage(image.id)"
                    class="mt-2 btn-outline text-xs"
                >
                Delete</button> -->
                <Link 
                :href="route('realtor.listing.image.destroy', { image: image.id })"
                method="delete"
                as="button"
                class="mt-2 btn-outline text-xs"
                >
                Delete</Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
    import { useForm,router,Link } from '@inertiajs/vue3'
    import { computed, ref } from 'vue'
    import { sweetAlert } from "../../../Composables/Sweet";
    import NProgress from 'nprogress'
    import Box from '../../../Comonents/UI/Box.vue';

    const props = defineProps(['listing'])

    const form = useForm({
        images: [],
    })

    const reset = () => {
        form.reset('images'),
        imageErrors.value = null
    }
    const canUpload = computed(() => form.images.length)
    //const imageErrors = computed(() => Object.values(form.errors))
    const imageErrors = ref("");

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
                    form.reset(),
                    imageErrors.value = null,
                    sweetAlert('success',"images added successfully.")
                },
                onError: (errors) => {
                    imageErrors.value = errors,
                    form.reset(),
                    sweetAlert('error',"An error has occurred.")
                }
            }
        )
    }

    router.on('progress', (event) => {
        if (event.detail.progress.percentage) {
            NProgress.set((event.detail.progress.percentage / 100) * 0.9)
        }
    })
    
    // const deleteImage = (id)=>{
    //     router.delete(
    //         route('realtor.listing.image.destroy', {ListingImage: id})
    //     )
    // }
</script>