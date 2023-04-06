<template>
    <form @submit.prevent="update">
      <div>
        <div>
          <label>Beds</label>
          <input v-model.number="form.beds" type="text" />
        </div>
  
        <div>
          <label>Baths</label>
          <input v-model.number="form.baths" type="text" />
        </div>
  
        <div>
          <label>Area</label>
          <input v-model.number="form.area" type="text" />
        </div>
  
        <div>
          <label>City</label>
          <input v-model="form.city" type="text" />
        </div>
  
        <div>
          <label>Post Code</label>
          <input v-model="form.code" type="text" />
        </div>
  
        <div>
          <label>Street</label>
          <input v-model="form.street" type="text" />
        </div>
  
        <div>
          <label>Street Nr</label>
          <input v-model.number="form.street_nr" type="text" />
        </div>
  
        <div>
          <label>Price</label>
          <input v-model.number="form.price" type="text" />
        </div>
  
        <div>
          <button type="submit">Update</button>
        </div>
      </div>
    </form>
</template>

<script setup>
    
    import { router } from '@inertiajs/vue3'

    import { reactive } from "vue"

    const props = defineProps(['listing'])
    const form = reactive({
        beds: props.listing.beds,
        baths: props.listing.baths,
        area: props.listing.area,
        city: props.listing.city,
        street: props.listing.street,
        code: props.listing.code,
        street_nr: props.listing.street_nr,
        price: props.listing.price,
    })

    function update() {
        router.post(
          `/update/${props.listing.id}`,
          form,
          {
            onSuccess: (page) =>{
              Swal.fire({
                toast: true,
                icon: "success",
                title: "Linsting modifié avec succées BILY !!",
                animation: false,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
              })
            },
            onError: (errors) => {
              alert('ohhhhh erreuurr!!')
            }
          }
        )
    }

</script>

<script>
    import MainLayout from "../Layouts/MainLayout.vue";

    export default{
        layout: MainLayout,
    }
</script>
  
<style scoped>
    label {
        margin-right: 2em;
    }

    div {
        padding: 2px
    }
</style>