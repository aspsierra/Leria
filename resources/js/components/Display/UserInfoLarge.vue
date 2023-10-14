<script setup>
import { AtIcon, MailIcon, CalendarIcon, LocationIcon } from '../Icons/_ExportIcons.js'


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
    <header class="-mt-20 lg:-mt-32 relative">
        <div class="top-0 left-0 rounded-full w-20 h-20 lg:w-40 lg:h-40 ring-4  "></div>
        <img class="absolute top-0 left-0 w-20 lg:w-40 z-40 rounded-full" :src="'/storage/' + userProfile.profile_pic" />
    </header>

    <body class="py-3 my-2 border rounded-lg px-5 text-sm lg:text-md">
        <div class="mb-3">
            <h4 class="text-lg font-bold">{{ userProfile.name }}</h4>
            <h4 class="flex gap-2">
                @ {{ userProfile.user_name }}
            </h4>
        </div>
        <p class="mb-3">
            {{ userProfile.bio }}
        </p>
        <div class="mb-3 flex lg:flex-col flex-row gap-1 flex-wrap">
            <p class="flex gap-1 lg:gap-2">
                <MailIcon /> {{ userProfile.email }}
            </p>
            <p class="flex gap-1  lg:gap-2">
                <LocationIcon /> {{ userProfile.location }}
            </p>
            <p class="flex gap-1 lg:gap-2">
                <CalendarIcon /> Se unió en {{ joinDate }}
            </p>
        </div>    
        <div class="flex flex-row justify-between lg:flex-col lg:gap-1">
            <p>{{ nPosts }} Posts</p>
            <p>{{ nFollowers }} Seguidores</p>
            <p>{{ nFollowing }} Siguiendo</p>
        </div>
            
        
    </body>
</template>