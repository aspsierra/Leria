<script setup>
import { LikeIcon, CommentIcon, ShareIcon } from '../Icons/_ExportIcons';
import { Link } from '@inertiajs/vue3';
import { ref, onBeforeMount } from 'vue';
import UserBrievInfo from './UserBrievInfo.vue';
import axios from 'axios';


const props = defineProps({
    post: Object,
    shared: Array,
    likes: Array
})

let postShared = ref(false)
let postLiked = ref(false);

for (const share of props.shared) {
    if (share.post_id == props.post.id) {
        postShared.value = true
    }
}

for (const like of props.likes) {
    if (like.post_id == props.post.id) {
        postLiked.value = true
    }
}

function dateFormatter(options, date) {
    options = JSON.parse(options)
    return new Intl.DateTimeFormat(Intl.DateTimeFormat().resolvedOptions().locale, options).format(date)
}

function displayDate() {
    let datePost = new Date(props.post.date + 'T' + props.post.time);
    let today = new Date();
    let options = {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    }

    if (today.getFullYear() > datePost.getFullYear()) {

        return dateFormatter(JSON.stringify({ day: options.day, month: options.month, year: options.year }), datePost)
    } else if (today.getMonth() > datePost.getMonth()) {

        return dateFormatter(JSON.stringify({ day: options.day, month: options.month }), datePost)
    } else if (today.getDate() > datePost.getDate()) {

        if ((today.getDate() - datePost.getDate()) < 7) {

            return (today.getDate() - datePost.getDate()) + 'd';
        } else {

            return dateFormatter(JSON.stringify({ day: options.day, month: options.month }), datePost)
        }
    }

    return dateFormatter(JSON.stringify({ hour: options.hour, minute: options.minute }), datePost)
}

let user = [];
let display = ref(false)

const displayUser = () => {
    axios.get('/user/' + props.post.user_name)
    .then(function(response){
        console.log(response);
        //display.value = true

    })
}

const hideUser = () => {
    display.value = false
}

</script>


<template >
    <div class="my-4 mx-2 flex gap-3">
        <div class="dropdown dropdown-hover" @mouseover="displayUser" @mouseleave="hideUser">
            <Link class="" :href="'/user/' + post.user_name">
            <div class="avatar ">
                <div class="w-10 h-10 rounded-full">
                    <img :src="'/storage/' + post.profile_pic" alt="Tailwind-CSS-Avatar-component" />
                </div>
            </div>
            </Link>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                <div v-if="display" v-for="post in posts.posts">
                    <UserBrievInfo/>
                </div>
                <div v-else class="flex justify-around mt-20">
                    <span class="loading loading-spinner loading-lg"></span>
                </div>
            </ul>
        </div>

        <div class="w-full">
            <header class="flex gap-2">
                <h2 class="font-semibold hover:underline">{{ post.name }}</h2>
                <h4 class="text-gray-500">{{ post.user_name }} · {{ displayDate() }}</h4>
            </header>

            <body>
                <p>{{ post.message }}</p>
            </body>

            <footer class="flex justify-evenly mt-2 ">
                <span class="flex gap-4 hover:text-purple-500">
                    <CommentIcon class="hover:scale-110  transition-all duration-300" />
                    {{ post.n_comments }}
                </span>
                <span class="flex gap-4 hover:text-green-500" :class="postShared == true ? 'text-green-500' : ''">
                    <ShareIcon :class="postShared == true ? 'stroke-green-500' : ''"
                        class="hover:scale-110  transition-transform duration-300" />
                    {{ post.n_shared }}
                </span>

                <span class="flex gap-4 hover:text-yellow-500 " :class="postLiked == true ? 'text-yellow-500' : ''">
                    <LikeIcon :class="postLiked == true ? 'stroke-yellow-500' : ''"
                        class="hover:scale-110 transition-all duration-300" />
                    {{ post.n_likes }}
                </span>

            </footer>
        </div>



    </div>
</template>