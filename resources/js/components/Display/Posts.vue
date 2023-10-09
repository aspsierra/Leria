<script setup>
import { LikeIcon, CommentIcon, ShareIcon } from '../Icons/_ExportIcons';


const props = defineProps({
    post: Object
})

</script>


<template >
    <div class="my-4 mx-2 flex gap-3">
        <div class="avatar">
            <div class="w-10 h-10 rounded-full">
                <img :src="'/storage/' + post.profile_pic" alt="Tailwind-CSS-Avatar-component" />
            </div>
        </div>

        <div class="w-full">
            <header class="flex gap-2">
                <h2 class="font-semibold hover:underline">{{ post.name }}</h2>
                <h4 class="font-thin">{{ post.user_name }}</h4>
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