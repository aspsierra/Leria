<script setup>
import { Head, Link } from '@inertiajs/vue3';
import UserLayout from '@/Layouts/UserLayout.vue';
import HoverProfilePic from '@/components/Display/HoverProfilePic.vue';

const props = defineProps({
    user: Object,
    data: Array,
    method: String
})

</script>

<template>
    <Head :title="method + ' - ' + user.user_name" />
    <UserLayout :scrollY="scrollY" class="container mx-auto" />
    <div class="container mx-auto lg:flex flex-row gap-1 mt-1">
        <div class="hidden lg:block lg:w-1/4" />
        <div class="lg:w-full mx-4">

            <p class="text-2xl font-bold">{{ user.name }}</p>
            <p class="text-sm font-light">@{{ user.user_name }}</p>

            <div class="lg:w-full border-b-2">
                <div class="tabs">
                    <Link :href='"/user/" + user.user_name + "/followers"'
                        :class="method == 'followers' ? 'tab-active' : ''" class="tab lg:tab-lg tab-bordered">Seguidores
                    </Link>
                    <Link :href='"/user/" + user.user_name + "/following"'
                        :class="method == 'following' ? 'tab-active' : ''" class="tab lg:tab-lg tab-bordered">Seguidos
                    </Link>
                </div>
            </div>

            <table class="table">
                <tbody>
                    <tr v-for="user in data" class="hover">

                        <td>
                            <Link :href="'/user/' + user.user_name" class="flex items-center space-x-3">
                            <HoverProfilePic :name="user.user_name" :pic="user.profile_pic" />

                            <div>
                                <div class="font-bold">{{ user.name }}</div>
                                <div>@{{ user.user_name }}</div>
                                <div class="text-sm opacity-50">{{ user.bio }}</div>
                            </div>

                            </Link>

                        </td>


                    </tr>
                </tbody>
            </table>

        </div>
        <div class="hidden lg:block lg:w-1/4" />

    </div>
</template>