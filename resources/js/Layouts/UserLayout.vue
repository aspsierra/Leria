<script setup>
import { PublishIcon, ArrowUpIcon } from '../components/Icons/_ExportIcons';
import ModalPublishPost from '@/components/Forms/ModalPublishPost.vue';
import SearchBarVue from '../components/Actions/SearchBar.vue';
import AvatarDropdown from '../components/Actions/AvatarDropdown.vue';
import BottomNavigation from '@/components/Display/BottomNavigation.vue';
import TopNavigation from '../components/Display/TopNavigation.vue'

const props = defineProps({
    scrollY: Number,
})

let screenWidth = window.innerWidth;

window.addEventListener('resize', function () {
    screenWidth = window.innerWidth;
})

</script>

<template>
    <div id="index" class="navbar bg-base-100 sticky top-0 z-50">
        <div class="navbar-start">
            <BottomNavigation class=" lg:hidden" />
            <TopNavigation class="hidden lg:block" />
        </div>
        <div class="navbar-center">
            <a class="btn btn-ghost normal-case text-xl">daisyUI</a>
        </div>
        <div class="navbar-end">
            <SearchBarVue :placeholder="'Buscar'" class="hidden lg:block" />
            <AvatarDropdown />
        </div>
    </div>
    <div v-if="scrollY > 100 || screenWidth < 1024" class='fixed bottom-10 right-10 my-8 float-right px-5 py-2'>
        <button class='btn btn-circle bg-purple-500 text-white border-0' onclick="my_modal_1.showModal()">
            <PublishIcon class="h-6 w-6" />
        </button>
    </div>
    <div v-if="scrollY > 100" class='fixed bottom-32 right-10 my-8 float-right px-5 py-2'>
        <button class='btn btn-circle bg-purple-500 text-white border-0'>
            <a href="#index">
                <ArrowUpIcon class="h-6 w-6" />
            </a>
        </button>
    </div>

<ModalPublishPost id="my_modal_1" /></template>