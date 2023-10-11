<script setup>
import { BellIcon, HomeIcon } from '../Icons/_ExportIcons';
import { Link, usePage, router } from '@inertiajs/vue3';

let page = usePage()

const currentRoute = window.location.pathname.split('/')[1]

const getActive = () => {
    //console.log(this);
    return 'tab-active'
}

</script>


<template>
    <div class="tabs">
        <Link href='/' class="tab tab-lg tab-bordered" :class="currentRoute == 'dashboard' ? 'tab-active' : ''">
            <HomeIcon class="mr-2"/>
            <span>Inicio</span>
                        
        </Link>
        <Link class="tab tab-lg tab-bordered indicator" :class="currentRoute == 'notifications' ? 'tab-active' : ''">
            <BellIcon class="mr-2"/>
            <span class="indicator-item badge badge-primary w-1"></span>
            <span class="">Notifications</span>
        </Link>
    </div>
</template>