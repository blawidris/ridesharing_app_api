<template>
      <div class="m-auto flex items-center justify-center">
            <div class="pt-40 text-left">
                  <form v-if="!waitingOnVerification" class="bg-white shadow-md px-5 py-8 w-[400px] flex flex-col"
                        method="post" @submit.prevent=handleLogin>
                        <label for="phone" class="text-base text-gray-600 font-semibold py-3">Enter your phone number</label>
                        <input type="phone" name="phone" id="phone" v-model="credentials.phone"
                              class="mt-2 mb-5 border-2 border-gray-200 w-full px-2 py-2 rounded-md text-base placeholder:text-gray-400 text-gray-500 focus:outline-none focus:border-gray-300"
                              placeholder="1 (234) 567 8910" v-maska data-maska="# (###) ###-####">
                        <button type="submit" class="bg-black text-white px-4 py-2.5 rounded-lg self-end">Continue</button>
                  </form>

                  <form v-else class="bg-white shadow-md px-5 py-8 w-[400px] flex flex-col" method="post"
                        @submit.prevent=handleVerification>

                        <label for="login_code" class="text-base text-gray-600 font-semibold py-3">Enter verification
                              code</label>
                        <input type="text" name="login_code" id="login_code" v-model="credentials.login_code"
                              class="mt-2 mb-5 border-2 border-gray-200 w-full px-2 py-2 rounded-md text-base placeholder:text-gray-400 text-gray-500 focus:outline-none focus:border-gray-300"
                              placeholder="578910" v-maska data-maska="######">

                        <button type="submit" class="bg-black text-white px-4 py-2.5 rounded-lg self-end">Verify</button>
                  </form>
            </div>
      </div>
</template>

<script setup>
import { vMaska } from "maska"
import { computed, onMounted, reactive, ref } from "vue";
import axios from 'axios'
import { useRouter } from "vue-router";


const router = useRouter();

const credentials = reactive({
      phone: null,
      login_code: null
})

const waitingOnVerification = ref(false);


onMounted(() => {
      if (localStorage.getItem('token')) {
            router.push({ name: 'landing' })
      }
});

const formattedCredentials = computed(() => {
      return {
            phone: credentials.phone.replaceAll(' ', '').replace('(', '').replace(')', '').replace('-', ''),
            login_code: credentials.login_code
      }
});

const handleLogin = () => {
      axios.post('http://localhost:8000/api/v1/login', formattedCredentials).then(response => {
            console.log(response.data);
            waitingOnVerification.value = true
      }).catch(error => {
            console.error(error);
            alert(error.response.data.message)
      });
}

const handleVerification = () => {
      axios.post('http://localhost:8000/api/v1/login/verify', formattedCredentials).then(response => {
            console.log(response.data); // authentication token

            // store user token
            localStorage.setItem('token', response.data)


            router.push({
                  name: "landing"
            })
      }).catch(error => {
            console.error(error);
            alert(error.response.data.message)
      });
}
</script>
