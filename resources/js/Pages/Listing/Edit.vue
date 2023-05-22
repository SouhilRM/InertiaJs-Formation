<template>
    <form @submit.prevent="update">
      <div class="grid grid-cols-6 gap-4">
        <div class="col-span-2">
          <label class="label">Beds</label>
          <input v-model.number="form.beds" type="text" class="input" />
        </div>
  
        <div class="col-span-2">
          <label class="label">Baths</label>
          <input v-model.number="form.baths" type="text" class="input" />
        </div>
  
        <div class="col-span-2">
          <label class="label">Area</label>
          <input v-model.number="form.area" type="text" class="input" />
        </div>
  
        <div class="col-span-2">
          <label class="label">City</label>
          <input v-model="form.city" type="text" class="input" />
        </div>
  
        <div class="col-span-2">
          <label class="label">Post Code</label>
          <input v-model="form.code" type="text" class="input" />
        </div>
  
        <div class="col-span-2">
          <label class="label">Street</label>
          <input v-model="form.street" type="text" class="input" />
        </div>
  
        <div class="col-span-2">
          <label class="label">Street Nr</label>
          <input v-model.number="form.street_nr" type="text" class="input" />
        </div>
  
        <div class="col-span-2">
          <label class="label">Price</label>
          <input v-model.number="form.price" type="text" class="input" />
        </div>
  
        <div class="col-span-6">
          <button type="submit" class="btn-primary">Update</button>
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