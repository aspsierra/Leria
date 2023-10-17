<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    userData: Array,
})
</script>

<template>
    <div class="ml-2">
        <header>
            <Link class="" :href="'/user/' + userData.user.user_name">
            <div class="avatar ">
                <div class="w-10 h-10 rounded-full">
                    <img class="hover:opacity-50 transition-all duration-200" :src="'/storage/' + userData.user.profile_pic"
                        alt="Tailwind-CSS-Avatar-component" />
                </div>
            </div>
            </Link>


            <div class="mt-1">
                <Link class="w-10" :href="'/user/' + userData.user.user_name">
                    <h4 class="text-lg font-bold hover:underline transition-all duration-200">{{ userData.user.name }}</h4>
                </Link>
                <Link class="" :href="'/user/' + userData.user.user_name">
                    <h4 class="text-sm">@{{ userData.user.user_name }}</h4>

                </Link>
            </div>

        </header>

        <body class="mt-2">
            <p>{{ userData.user.bio }}</p>

        </body>

        <footer class="flex justify-evenly mt-4">
            <div>
                <h3 class="font-semibold text-gray-500">Siguiendo</h3>
                <h2 class="text-md font-bold">{{ userData.nFollowing }}</h2>
            </div>
            <div>
                <h3 class="font-semibold text-gray-500">Seguidores</h3>
                <h2 class="text-md font-bold">{{ userData.nFollowers }}</h2>
            </div>
        </footer>
    </div>
</template>