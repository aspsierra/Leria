<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';

const props = defineProps({
    pic:String,
})

const form = useForm({
    userPost: ''
})

const submit = () =>{
    form.post('/publishPost?tz=' + Intl.DateTimeFormat().resolvedOptions().timeZone);
}
</script>
<template>
    <form class="p-4" @submit.prevent="">
        <div class="flex flex-row gap-4 w-full">
            <div class="avatar">
                <div class="w-20 h-20 rounded-full">
                    <img :src="'/storage/' + pic" />
                </div>
            </div>

            <div class="w-full">
                <InputLabel class="hidden" for="userPost" value="Nombre de usuario" />
                <textarea class="textarea textarea-bordered w-full max-h-xs resize-none"
                :class="form.errors.userPost ? 'input-error' : ''"
                placeholder="Que estás argallando?" maxlength="140" rows="2"
                v-model="form.userPost" />
            </div>
        </div>
        <div class="w-full flex justify-between">
            <InputError class="mt-1 ml-24 min-h-6" :message="form.errors.userPost" />
            <button class="btn btn-primary" @click="submit">Publicar</button>
        </div>
    </form>
</template>