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
        <p>Benvido</p>

    </div>
</template>