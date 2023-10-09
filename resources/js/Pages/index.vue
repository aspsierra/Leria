<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayoutVue from '@/Layouts/GuestLayout.vue';
import UserLayout from '@/Layouts/UserLayout.vue';
import PublishPostLarge from '../components/Forms/PublishPostLarge.vue'
import Posts from '../components/Display/Posts.vue'
import { ref } from 'vue';

import axios from 'axios';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    user: Object,
    posts: Array
})

const logout = () => {
    axios.post('/logout')
}

const form = useForm({
    post: ''
})

</script>
<template>
    <Head title='Inicio' />
    <component :is="user === null ? GuestLayoutVue : UserLayout" :avatar="user.profile_pic" class="container mx-auto" />
    <div class="container mx-auto lg:flex flex-row gap-1 mt-1">
        <section class="hidden bg-red-400 lg:block  lg:w-1/4">
            ssss
        </section>
        <section class="bg-green-500 lg:w-2/4 mx-4">
            <div class="hidden lg:block bg-purple-300">
                <PublishPostLarge :pic="user.profile_pic"/>
            </div>
            <div v-for="post in posts">
                <Posts :post="post"/>
            </div>
        </section>
        <section class="hidden bg-blue-700 lg:block lg:w-1/4">
            ssss
        </section>
    </div>
</template>