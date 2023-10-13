<script setup>
import { AtIcon, MailIcon, CalendarIcon } from '../Icons/_ExportIcons.js'


const props = defineProps({
    userProfile: Object,
    nFollowers: Number,
    nFollowing: Number,
    nPosts: Number,
})

let joinDate = new Intl.DateTimeFormat(Intl.DateTimeFormat().resolvedOptions().locale, {
    month: 'long',
    year: 'numeric'
}).format(new Date(props.userProfile.register_date));

</script>
<template>
    <header class="-mt-32 relative">
        <div class="top-0 left-0 rounded-full w-40 h-40 ring-4 ring-gray-800 bg-gray-800"></div>
        <img class="absolute top-0 left-0 w-40 z-40 rounded-full" :src="'/storage/' + userProfile.profile_pic" />
    </header>

    <body class="py-3 mt-2 border rounded-lg pl-5">
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
        <p>{{ nPosts }} Posts</p>
        <p>{{ nFollowers }} Seguidores</p>
        <p>{{ nFollowing }} Siguiendo</p>
    </body>
</template>