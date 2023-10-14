<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import GuestLayoutVue from '@/Layouts/GuestLayout.vue';
import UserLayout from '@/Layouts/UserLayout.vue';
import PublishPostLarge from '../components/Forms/PublishPostLarge.vue'
import Posts from '../components/Display/Posts.vue'
import UserBrievInfo from '@/components/Display/UserBrievInfo.vue';
import { ref, onBeforeMount } from 'vue';

const props = defineProps({
    user: Object,
    nPosts: Number,
    nFollowers: Number,
    nFollowing: Number,
})

let scrollY = ref(window.scrollY);
let foundUserPosts = ref(false)
let posts = []

function scrollPosition() {
    scrollY.value = window.scrollY;
}

onBeforeMount(() => {
    foundUserPosts.value = false
    axios.get('/getAllPosts/' + props.user.id)
    .then(function (response) {
            posts = response.data
            foundUserPosts.value = true
        })
})

</script>
<template>
    <Head title='Inicio' />
    <component :is="user === null ? GuestLayoutVue : UserLayout" :scrollY="scrollY" class="container mx-auto" />
    <div class="container mx-auto lg:flex flex-row gap-1 mt-1" @wheel="scrollPosition()">
        <section class="hidden bg-red-400 lg:block  lg:w-1/4">
            <UserBrievInfo :user="user" :posts="nPosts" :following="nFollowing" :followers="nFollowers" />
        </section>
        <section class="bg-gray-700 lg:w-2/4 mx-4">
            <div class="hidden lg:block bg-purple-300">
                <PublishPostLarge :pic="user.profile_pic" />
            </div>


            <div v-if="foundUserPosts" v-for="post in posts.posts">
                <Posts :post="post" :shared="posts.shares" />
            </div>
            <div v-else-if="foundUserPosts && posts.length <= 0" class="flex flex-col mt-20 items-center">
                <SearchIcon class="h-1/4 w-1/4" />
                <p class="text-lg">No se han encontrado posts</p>
            </div>
            <div v-else class="flex justify-around mt-20">
                <span class="loading loading-spinner loading-lg"></span>
            </div>


        </section>
        <section class="hidden bg-blue-700 lg:block lg:w-1/4">
            ssss
        </section>
    </div>
</template>