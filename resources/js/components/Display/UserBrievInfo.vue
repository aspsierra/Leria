<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    userData: Array,
})
</script>

<template>
    <div class="bg-indigo-300">
        <img class="object-cover h-36 w-full" src="/storage/default_background.jpg" alt="">
    </div>
    <div class="  pb-4" >
        <header class="flex gap-2 ml-5">
            <div class="-mt-8 relative">
                <div class="top-0 left-0 rounded-full w-20 h-20 ring-4 bg-purple-500 ring-purple-500"></div>
                <img class="absolute top-0 left-0 w-20 z-40 rounded-full" :src="'/storage/' + userData.user.profile_pic" />
            </div>
            <div class="inline-block align-baseline">
                <h4 class="text-lg font-bold">{{ userData.user.name }}</h4>
                <h4 class="text-sm">{{ userData.user.user_name }}</h4>
            </div>
        </header>

        <body class="flex justify-evenly mt-4">
            <div class="">
                <h3 class="font-semibold text-gray-500">Posts</h3>
                <h2 class="text-lg font-bold">{{ userData.nPosts }}</h2>
            </div>
            <Link :href="'/user/' + userData.user.user_name + '/following'" class="hover:underline">
                <h3 class="font-semibold text-gray-500">Siguiendo</h3>
                <h2 class="text-lg font-bold">{{ userData.nFollowing }}</h2>
            </Link>
            <Link :href="'/user/' + userData.user.user_name + '/followers'" class="hover:underline">
                <h3 class="font-semibold text-gray-500">Seguidores</h3>
                <h2 class="text-lg font-bold">{{ userData.nFollowers }}</h2>
            </Link>
        </body>
    </div>
</template>