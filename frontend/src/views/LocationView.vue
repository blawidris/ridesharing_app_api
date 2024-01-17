<template>
      <div class="m-auto flex items-center justify-center">
            <div class="pt-40 text-left">
                  <form class="bg-white shadow-md px-5 py-8 w-[400px] flex flex-col" method="post"
                        @submit.prevent=handleLogin>
                        <label for="tocation" class="text-base text-gray-600 font-semibold py-3">Where are you going?</label>

                        <GMapAutocomplete
                              class="mt-2 mb-5 border-2 w-full px-2 py-4 rounded-md text-base placeholder:text-gray-400 text-gray-500 focus:outline-none border-gray-400 focus:border-gray-600"
                              placeholder="My destination" @place_changed="handleLocationChange">
                        </GMapAutocomplete>

                        <button type="submit" class="bg-black text-white px-4 py-2.5 rounded-lg self-end"
                              @click.prevent="handleSelectLocation">Find a ride</button>
                  </form>
            </div>
      </div>
</template>

<script setup>

import { useRouter } from 'vue-router';
import { useLocationStore } from '@/stores/location'

const location = useLocationStore();
const router = useRouter();

const handleLocationChange = (e) => {

      location.$patch({
            destination: {
                  name: e.name,
                  address: e.formatted_address,
                  geometry: {
                        lat: e.geometry.location.lat(),
                        lng: e.geometry.location.lng()
                  }
            }
      })
}


const handleSelectLocation = () => {
      if (location.destination.name !== '') {
            router.push({
                  name: 'map'
            })
      }
}
</script>