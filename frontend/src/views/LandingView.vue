<template>
      <div class="m-auto flex items-center justify-center">
            <div class="pt-40 text-left">
                  <form class="bg-white shadow-md px-5 py-8 w-[400px] flex"
                        method="post">
                        <div class="flex justify-between w-full self-center items-center">
                              <button type="button" class="bg-black text-white px-5 py-3 rounded-lg self-end">Start Driving</button>

                              <button @click.prevent="handleFindARide" type="button" class="bg-black text-white px-5 py-3 rounded-lg self-end">Find a ride</button>
                        </div>
                  </form>
            </div>
      </div>
</template>

<script setup>
import { useRouter } from 'vue-router';


const router = useRouter();

const handleFindARide = () =>{
      router.push({
            name: 'location'
      })
}
</script>