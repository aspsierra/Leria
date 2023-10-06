<script setup>
import { BellIcon, HomeIcon } from '../Icons/_ExportIcons';
import { Link } from '@inertiajs/vue3';
</script>


<template>
    <div class="tabs">
        <Link class="tab tab-lg tab-bordered tab-active">
            <HomeIcon class="mr-2"/>
            <span>Inicio</span>
                        
        </Link>
        <Link class="tab tab-lg tab-bordered indicator">
            <BellIcon class="mr-2"/>
            <span class="indicator-item badge badge-primary w-1"></span>
            <span class="">Notifications</span>
        </Link>
    </div>
</template>