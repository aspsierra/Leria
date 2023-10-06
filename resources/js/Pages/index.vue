<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayoutVue from '@/Layouts/GuestLayout.vue';
import UserLayout from '@/Layouts/UserLayout.vue';
import PublishPostLarge from '../components/Forms/PublishPostLarge.vue'
import { ref } from 'vue';

import axios from 'axios';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    user: Object
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
    <div class="container mx-auto flex flex-row gap-1 mt-1">
        <section class="bg-red-400 w-1/4">
            ssss
        </section>
        <section class="bg-green-700 w-2/4">

            <div class="hidden lg:block bg-purple-300">
                <PublishPostLarge :pic="user.profile_pic"/>
            </div>
        </section>
        <section class="bg-blue-700 w-1/4">
            ssss
        </section>
    </div>
</template>