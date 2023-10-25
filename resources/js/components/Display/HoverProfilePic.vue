<script setup>

import UserModal from './UserModal.vue';
import axios from 'axios';
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

let user = [];
let display = ref(false)

const props = defineProps({
    name: String,
    pic: String
})

const displayUser = () => {
    if (!display.value) {
        axios.post('/user/getData/' + props.name)
            .then(function (response) {
                console.log(response);
                user = response.data
                display.value = true

            })
    }
}

const hideUser = () => {
    display.value = false
}

</script>
<template>
    <div class="dropdown dropdown-hover" @mouseover="displayUser" @mouseleave="hideUser">
            <Link class="" :href="'/user/' + name">
            <div class="avatar ">
                <div class="w-10 h-10 rounded-full">
                    <img class="hover:opacity-50 transition-all duration-200" :src="'/storage/' + pic" alt="Tailwind-CSS-Avatar-component" />
                </div>
            </div>
            </Link>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2  shadow-md shadow-gray-800 dark:shadow-gray-300 bg-base-100 rounded-box w-64">
                <div v-if="display">
                    <UserModal :userData="user" />
                </div>
                <div v-else class="flex justify-around mt-20">
                    <span class="loading loading-spinner loading-lg"></span>
                </div>
            </ul>
        </div>
</template>