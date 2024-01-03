<template>
      <div class="m-auto flex items-center justify-center">
            <div class="pt-40 text-left">
                  <form class="bg-white shadow-md px-5 py-8 w-[400px] flex flex-col" method="post"
                        @submit.prevent=handleLogin>
                        <label for="tocation" class="text-base text-gray-600 font-semibold py-3">Where are you going?</label>

                        <GMapAutocomplete
                              class="mt-2 mb-5 border-2 border-gray-200 w-full px-2 py-2 rounded-md text-base placeholder:text-gray-400 text-gray-500 focus:outline-none focus:border-gray-300"
                              placeholder="My destination" @place_changed="handleLocationChange">
                        </GMapAutocomplete>

                        <button type="submit" class="bg-black text-white px-4 py-2.5 rounded-lg self-end">Find a ride</button>
                  </form>
            </div>
      </div>
</template>

<script setup>

const handleLocationChange = () => { }
</script>