<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import Posts from '../components/Display/Posts.vue'

import { AtIcon, MailIcon, CalendarIcon, SearchIcon } from '../components/Icons/_ExportIcons.js'
import { onMounted, onBeforeMount } from 'vue';
import { ref } from 'vue';
import { defineAsyncComponent } from 'vue';
import axios from 'axios';

//const Posts = defineAsyncComponent(() => import('../components/Display/Posts.vue'))

const props = defineProps({
    user: Object,
    nPosts: Number,
    nFollowers: Number,
    nFollowing: Number,
})

let posts = []
let foundUserPosts = ref(false)

const cont = ref();

let userProfile = props.user;

if (Array.isArray(props.user)) {
    userProfile = props.user[0];
}

let joinDate = new Intl.DateTimeFormat(Intl.DateTimeFormat().resolvedOptions().locale, {
    month: 'long',
    year: 'numeric'
}).format(new Date(userProfile.register_date));

onBeforeMount(() => {
    axios.get('/test?user=' + userProfile.id)
        .then(function (response) {
            posts = response.data
            foundUserPosts.value = true
        }
        )
})

</script>

<template>
    <UserLayout :avatar="userProfile.profile_pic" :scrollY="scrollY" class="container mx-auto" />
    <div class="container mx-auto">
        <div class="bg-indigo-300">
            <img class="object-cover h-40 w-full" src="/storage/default_background.jpg" alt="">
        </div>
        <div class="container mx-auto lg:flex flex-row gap-1 mt-1" @wheel="scrollPosition()">
            <section class="lg:block pl-5 lg:w-1/4">
                <header class="">
                    <div class="-mt-32 relative">
                        <div class="top-0 left-0 rounded-full w-40 h-40 ring-4 ring-gray-800 bg-gray-800"></div>
                        <img class="absolute top-0 left-0 w-40 z-40 rounded-full"
                            :src="'/storage/' + userProfile.profile_pic" />
                    </div>
                </header>

                <body class="py-3 mt-2 border rounded-lg  pl-5">
                    <h4 class="text-lg font-bold">{{ userProfile.name }}</h4>
                    <h4 class="flex gap-2">
                        <AtIcon />{{ userProfile.user_name }}
                    </h4>
                    <p class="flex gap-2">
                        <MailIcon /> {{ userProfile.email }}
                    </p>
                    <p class="flex gap-2">
                        <CalendarIcon /> Se unió en {{ joinDate }}
                    </p>
                    <p>{{ nFollowers }} Seguidores</p>
                    <p>{{ nFollowing }} Siguiendo</p>
                </body>
            </section>

            <section class="bg-gray-700 min-h-screen lg:w-2/4 mx-4">
                <div class="w-full">
                    <div class="tabs">
                        <a class="tab tab-lg tab-bordered tab-active">Posts</a>
                        <a class="tab tab-lg tab-bordered ">Compartidos</a>
                        <a class="tab tab-lg tab-bordered">Favoritos</a>
                    </div>
                </div>
                <div v-if="foundUserPosts" v-for="post in posts" class="divide divide-y">
                    <Posts :post="post" />
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