<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
const props = defineProps({
    pic:String,
})
const form = useForm({
    post: ''
})
</script>
<template>
    <form class="p-4" @submit.prevent="">
        <div class="flex flex-row gap-2 w-full">
            <div class="avatar">
                <div class="w-20 rounded-full">
                    <img :src="'/storage/' + pic" />
                </div>
            </div>

            <div class="w-full">
                <InputLabel for="post" value="Nombre de usuario" />
                <textarea class="textarea textarea-bordered w-full max-h-xs resize-none" placeholder="Que estás argallando?"
                    maxlength="140" rows="2" />
            </div>
        </div>
        <div class="w-full flex justify-end">
            <button class="btn btn-primary">Publicar</button>
        </div>
    </form>
</template>