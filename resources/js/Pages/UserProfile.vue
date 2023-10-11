<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import UserBrievInfo from '@/components/Display/UserBrievInfo.vue';

const props = defineProps({
    user: Object,
    nPosts: Number,
    nFollowers: Number,
    nFollowing: Number,
})

</script>

<template>
    <UserLayout :avatar="user.profile_pic" :scrollY="scrollY" class="container mx-auto" />
    <div class="container mx-auto">
        <UserBrievInfo :user="user" :posts="nPosts" :following="nFollowing" :followers="nFollowers" />

    </div>
</template>