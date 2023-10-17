<script setup>
import { SearchIcon } from '../components/Icons/_ExportIcons.js'
import { Head } from '@inertiajs/vue3';
import UserLayout from '@/Layouts/UserLayout.vue';
import Posts from '../components/Display/Posts.vue'
import UserInfoLarge from '@/components/Display/UserInfoLarge.vue';

import { onBeforeMount } from 'vue';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    user: String,
})

console.log(props.user);
let posts = []
let userData = [];
let tab = ref('P')
let foundUser= ref(false)
let foundUserPosts = ref(false)

const getUserData = () =>{
    foundUser.value = false
    axios.post('/user/getData/' + props.user)
    .then(function(response){
        userData = response.data
        foundUser.value = true
    })
}

const getPosts = (link = 'posts', clickTab = 'P') => {
    foundUserPosts.value = false
    tab.value = clickTab
    axios.post('/user/' + props.user + '/' + link)
    .then(function (response) {
            posts = response.data
            foundUserPosts.value = true
        })
}

onBeforeMount(() => {
    getUserData();
    getPosts();
})
let scrollY = ref(window.scrollY);

function scrollPosition() {
    scrollY.value = window.scrollY;
}

</script>

<template>
    <Head :title="user" />
    <UserLayout :scrollY="scrollY" class="container mx-auto" />
    <div class="container mx-auto" @wheel="scrollPosition()">
        <div class="bg-indigo-300">
            <img class="object-cover h-40 w-full" src="/storage/default_background.jpg" alt="">
        </div>
        <div class="container mx-auto lg:flex flex-row gap-1 mt-1" @wheel="scrollPosition()">
            <!-- USER INFO -->
            <section class="lg:block px-5 lg:w-1/4">
                <div v-if="foundUser">
                    <UserInfoLarge :userData="userData" />
                </div>
                <div v-else>
                    <span class="loading loading-spinner loading-lg"></span>
                </div>
            </section>
            <!-- CONTENT -->
            <section class=" min-h-screen lg:w-2/4 mx-4">
                <div class="w-full border-b-2">
                    <div class="tabs">
                        <a @click="getPosts()" :class="tab == 'P' ? 'tab-active' : ''" class="tab lg:tab-lg tab-bordered">Posts</a>
                        <a @click="getPosts('shares', 'S')" :class="tab == 'S' ? 'tab-active' : ''" class="tab lg:tab-lg tab-bordered">Compartidos</a>
                        <a @click="getPosts('likes', 'L')" :class="tab == 'L' ? 'tab-active' : ''" class="tab lg:tab-lg tab-bordered">Favoritos</a>
                    </div>
                </div>

                <!-- POSTS -->
                <div v-if="foundUserPosts" v-for="post in posts.posts" >
                    <Posts :post="post" :shared="posts.shares" :likes="posts.likes"/>
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
            </section>
        </div>
        <!-- <UserBrievInfo :user="userProfile" :posts="nPosts" :following="nFollowing" :followers="nFollowers" /> -->

    </div>
</template>