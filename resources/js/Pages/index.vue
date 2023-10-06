<script setup>
import { Link } from '@inertiajs/vue3';
import GuestLayoutVue from '@/Layouts/GuestLayout.vue';
import UserLayout from '@/Layouts/UserLayout.vue';
import { ref } from 'vue';

import axios from 'axios';

const props = defineProps({
    user: Object
})

const logout = () =>{
    axios.post('/logout')
}

</script>
<template>
    <head title='Inicio' />
    <component :is="user === null ? GuestLayoutVue : UserLayout" :avatar = "user.profile_pic"
    class="container mx-auto"/>
    <div class="container mx-auto">
        <p>Benvido </p><p v-if=" user !== null">{{ user.name }}</p>
        <div class="avatar">
            <div class="w-24 rounded">
                <img :src="'/storage/' + user.profile_pic "/>
            </div>
        </div>
        <button class="btn btn-accent" @click="logout">LOgout</button>
    </div>
</template>