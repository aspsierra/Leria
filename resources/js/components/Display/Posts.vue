<script setup>
import { LikeIcon, CommentIcon, ShareIcon } from '../Icons/_ExportIcons';


const props = defineProps({
    post: Object
})

function displayDate() {
    let datePost = new Date(props.post.date);
    let today = new Date();

    console.log(today.toLocaleDateString() > datePost.toLocaleDateString());
    if(today.toLocaleDateString() > datePost.toLocaleDateString()){
        return datePost.toLocaleDateString()
    } 
    
    let time = [props.post.time.split(':')[0],props.post.time.split(':')[1],props.post.time.split(':')[2]]
    let timePost = new Date();
    timePost.setHours(time[0]);
    timePost.setMinutes(time[1]);
    timePost.setSeconds(time[2]);

    console.log(today.getHours() - timePost.getHours());
        // 13                   12
    if(today.getHours() > timePost.getHours()){
        return 'Hace ' + (today.getHours() - timePost.getHours()) +' h.'
    } else if(today.getMinutes() > timePost.getMinutes()){
        return 'Hace ' + (today.getMinutes() - timePost.getMinutes()) +' mins.'
    } else{
        return 'Hace ' + (today.getSeconds() - timePost.getSeconds()) +' segs.'
    }
}

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