<script setup>
import { BellIcon } from '../components/Icons/_ExportIcons';
import SearchBarVue from '../components/Actions/SearchBar.vue';
import AvatarDropdown from '../components/Actions/AvatarDropdown.vue';
import BottomNavigation from '@/components/Display/BottomNavigation.vue';
import TopNavigation from '../components/Display/TopNavigation.vue'
import { ref } from 'vue';

const props = defineProps({
    avatar: String
})

let width = ref(window.innerWidth);

</script>

<template>
    <div class="navbar bg-base-100">
        <div class="navbar-start">
            <BottomNavigation class="lg:hidden" />
            <TopNavigation class="hidden lg:block"/>
        </div>
        <div class="navbar-center">
            <a class="btn btn-ghost normal-case text-xl">daisyUI</a>
        </div>
        <div class="navbar-end">
            <SearchBarVue :placeholder="'Buscar'" class="hidden lg:block" />
            <!-- <button class="btn btn-ghost btn-circle">
                <div class="indicator hidden lg:block">
                    <BellIcon />
                    <span class="badge badge-xs badge-primary indicator-item"></span>
                </div>
            </button> -->
            <AvatarDropdown :avatar="avatar" />
        </div>
    </div>
</template>