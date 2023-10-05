<script setup>

import GuestLayoutVue from '@/Layouts/GuestLayout.vue';
import { ref } from 'vue';

const props = defineProps({
    user: Object
})

</script>
<template>
    <head title='Inicio' />
    <component :is="user === null ? GuestLayoutVue : 'div'" />
    <div class="container mx-auto">
        <p>Benvido {{ user.name }}</p>
        <div class="avatar">
            <div class="w-24 rounded">
                <img :src="'../../..' + user.profile_pic" />
            </div>
        </div>
    </div>
</template>