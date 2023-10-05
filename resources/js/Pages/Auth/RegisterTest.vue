<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    name: '',
    surname: '',
    // userName: '',
    // email: '',
    // password: '',
    // passwordConfirm: '',
});

const submit = () => {
    form.post('/register');
};

let step = ref(1);

</script>

<template>
    <Head title="TEST" />

</template>
