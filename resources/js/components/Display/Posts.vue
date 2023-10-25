<script setup>
import { LikeIcon, CommentIcon, ShareIcon } from '../Icons/_ExportIcons';
import { ref } from 'vue';
import HoverProfilePic from './HoverProfilePic.vue';

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

</script>


<template >
    <div class="my-4 mx-2 flex gap-3">

        <HoverProfilePic :name="post.user_name" :pic="post.profile_pic"/>

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