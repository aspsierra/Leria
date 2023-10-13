<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import GuestLayoutVue from '@/Layouts/GuestLayout.vue';
import UserLayout from '@/Layouts/UserLayout.vue';
import PublishPostLarge from '../components/Forms/PublishPostLarge.vue'
import Posts from '../components/Display/Posts.vue'
import UserBrievInfo from '@/components/Display/UserBrievInfo.vue';
import { ref } from 'vue';

const props = defineProps({
    user: Object,
    posts: Array,
    nPosts: Number,
    nFollowers: Number,
    nFollowing: Number,
})

let scrollY = ref(window.scrollY);

function scrollPosition(){
    scrollY.value = window.scrollY;
}

</script>
<template>
    <Head title='Inicio' />
    <component :is="user === null ? GuestLayoutVue : UserLayout" :scrollY="scrollY" class="container mx-auto" />
    <div class="container mx-auto lg:flex flex-row gap-1 mt-1" @wheel="scrollPosition()">
        <section class="hidden bg-red-400 lg:block  lg:w-1/4">
            <UserBrievInfo :user="user" :posts="nPosts" :following="nFollowing" :followers="nFollowers"/>
        </section>
        <section class="bg-gray-700 lg:w-2/4 mx-4">
            <div class="hidden lg:block bg-purple-300">
                <PublishPostLarge :pic="user.profile_pic"/>
            </div>
            <div v-for="post in posts" class="divide divide-y">
                <Posts :post="post"/>
            </div>
        </section>
        <section class="hidden bg-blue-700 lg:block lg:w-1/4">
            ssss
        </section>
    </div>
</template>