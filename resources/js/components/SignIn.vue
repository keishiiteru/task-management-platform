<template>
    <div class="w-full min-h-screen bg-gray-50 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md p-5 mx-auto">
            <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label class="block mb-1" for="email">Email-Address</label>
                <input id="email" type="text" name="email" v-model="form.email" class="py-2 px-3 border border-gray-300 focus:border-teal-light focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
            </div>
            <div class="mb-4">
                <label class="block mb-1" for="password">Password</label>
                <input id="password" type="password" name="password" v-model="form.password" class="py-2 px-3 border border-gray-300 focus:border-teal-light focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
            </div>
            <div class="mt-6 flex items-center justify-between">
                <div class="flex items-center">
                <input id="remember_me" type="checkbox" class="border border-gray-300 text-teal shadow-sm focus:border-teal-light focus:ring focus:ring-red-200 focus:ring-opacity-50" />
                <label for="remember_me" class="ml-2 block text-sm leading-5 text-gray-900"> Remember me </label>
                </div>
                <a href="#" class="text-sm"> Forgot your password? </a>
            </div>
            <div class="mt-6">
                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-teal border border-transparent rounded-md font-semibold capitalize text-white hover:bg-very-dark-blue active:bg-very-dark-blue focus:outline-none focus:border-very-dark-blue focus:ring focus:ring-red-200 disabled:opacity-25 transition">Sign In</button>
            </div>
            <div class="mt-6 text-center">
                <a href="#" class="underline">Sign up for an account</a>
            </div>
            </form>
        </div>
    </div>
</template>

<script setup>
    import { ref } from "vue"
    import { useRouter } from "vue-router"

    const form = ref({
        email:  '',
        password: ''
    })

    const submitForm = async() => {
        try {
            const res = await axios.post('/api/login',form.value)
            const token = res.data.token
            const user = res.data.user

             if(token){
                localStorage.setItem('token', token)
                localStorage.setItem('user', JSON.stringify(user))
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                window.location.href = '/'
            }

        } catch(error) {
            console.error(error)
        }
    }

</script>
