<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';

const props = defineProps({
    pic: String,
})

const form = useForm({
    userPost: ''
})

const submit = () => {
    form.post('/publishPost?tz=' + Intl.DateTimeFormat().resolvedOptions().timeZone + '&alert=1');
}
</script>

<template>
    <dialog class="modal">
        <div class="modal-box">
            <form @submit.prevent="">
                <div class="w-full">
                    <div class="avatar">
                        <div class="w-10 h-10 rounded-full">
                            <img :src="'/storage/' + pic" />
                        </div>
                    </div>
                    <div class="w-full">
                        <InputLabel class="hidden" for="userPost" value="Nombre de usuario" />
                        <textarea class="textarea textarea-bordered w-full max-h-xs resize-none"
                            :class="form.errors.userPost ? 'input-error' : ''" placeholder="Que estás argallando?"
                            maxlength="140" rows="2" v-model="form.userPost" />
                    </div>
                </div>
                
                <div class="modal-action">
                    <form method="dialog" class="w-full flex justify-between">
                        <button class="btn btn-primary" @click="submit">Publicar</button>
                        <button class="btn">Close</button>
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                </div>
            </form>
        </div>
    </dialog>
</template>