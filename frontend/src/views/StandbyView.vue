<template>
      <div class="pt-16">
            <h1 class="text-3xl font-semibold mb-4">{{ title }}</h1>
            <div  class="mt-8 flex justify-center">
                  <Loader />
            </div>

            <!-- <div v-else>
                  <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
                        <div class="bg-white px-4 py-5 sm:p-6">
                              <div>
                                    <GMapMap :zoom="14" :center="trip.destination" ref="gMap"
                                          style="width:100%; height: 256px;"></GMapMap>
                              </div>
                              <div class="mt-2">
                                    <p class="text-xl">Going to <strong>{{ trip.destination_name }}</strong></p>
                              </div>
                        </div>
                        <div class="flex justify-between bg-gray-50 px-4 py-3 text-right sm:px-6">
                              <button @click="handleDeclineTrip"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none">Decline</button>
                              <button @click="handleAcceptTrip"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none">Accept</button>
                        </div>
                  </div>
            </div> -->
      </div>
</template>

<script setup>

import Loader from '@/components/Loader.vue';
import { onMounted, ref } from 'vue';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

const title = 'Waiting for ride request';


onMounted(()=>{
      let echo = new Echo({
            broadcaster: 'pusher',
            key: 'myKey',
            cluster: 'mt1',
            forceTLS: false,
            disableStats: true,
            wsPort: 6001,
            wsHost: window.location.hostname,
            enabledTransports: ['ws', 'wss'],
      })

      echo.channel('drivers').listen('TripCreated', e => {
            console.log(e);
      })
})

</script>