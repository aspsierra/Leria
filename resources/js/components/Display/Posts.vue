<script setup>
import { LikeIcon, CommentIcon, ShareIcon } from '../Icons/_ExportIcons';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    post: Object
})

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
        <Link :href="'/profile?user=' + post.user_id">
        
            <div class="avatar">
                <div class="w-10 h-10 rounded-full">
                    <img :src="'/storage/' + post.profile_pic" alt="Tailwind-CSS-Avatar-component" />
                </div>
            </div>
        </Link>

        <div class="w-full">
            <header class="flex gap-2">
                <h2 class="font-semibold hover:underline">{{ post.name }}</h2>
                <h4 class="text-gray-500">{{ post.user_name }} · {{ displayDate() }}</h4>
            </header>

            <body>
                <p>{{ post.message }}</p>
            </body>

            <footer class="flex justify-evenly mt-2">
                <span class="flex gap-4">
                    <CommentIcon class="hover:scale-110 hover:text-purple-500 transition-all duration-300" />
                    {{ post.n_comments }}
                </span>
                <span class="flex gap-4">
                    <ShareIcon class="hover:scale-110 hover:text-green-500 transition-all duration-300" />
                    {{ post.n_shared }}
                </span>

                <span class="flex gap-4">
                    <LikeIcon class="hover:scale-110 hover:text-yellow-500 transition-all duration-300" />
                    {{ post.n_likes }}
                </span>

            </footer>
        </div>



    </div>
</template>