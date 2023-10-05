<script setup>
//import Checkbox from '@/Components/Checkbox.vue';
//import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    user_name: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post('/login');
};
</script>

<template>

    <Head title="Log in" />

    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="text-center lg:text-left max-w-xl">
                <h1 class="text-5xl font-bold">Login now!</h1>
                <p class="py-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi repellendus fuga maxime. Dolorem vero ullam earum vitae numquam voluptatum minima eius quos est velit, porro architecto ipsam fugiat? Similique, nulla.</p>
            </div>
            <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form class="card-body" @submit.prevent="">
                    <div class="form-control">
                        <InputLabel for="user_name" value="Nombre de usuario" />

                        <TextInput id="user_name" type="text" class="mt-1 block w-full" v-model="form.user_name" required
                            autofocus autocomplete="user_name" placeHolder="Nombre de usuario" />

                        <InputError class="mt-2" :message="form.errors.userName" />
                    </div>
                    <div class="form-control mt-4">
                        <InputLabel for="password" value="Contraseña" />

                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                            autocomplete="current-password" placeHolder="Contraseña" />

                        <InputError class="mt-2" :message="form.errors.password" />

                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <Link v-if="canResetPassword" :href="route('password.request')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Forgot your password?
                        </Link>
                    </div>
                    <div class="mt-4">
                        <InputLabel for="remember" />
                        <Checkbox name="remember" v-model:checked="form.remember" message="Remember me"/>
                    </div>

                    <div class="form-control mt-6">
                        <button class="btn btn-primary" @click="submit">Login</button>
                    </div>
                </form>
                <div class="card-body pt-0 flex w-full" >               
                    <p>¿No tienes cuenta?</p>
                    <Link href="/register" class="btn btn-secondary">Regístrate</Link>
                </div>
            </div>
        </div>
    </div>



    <!-- <form @submit.prevent="submit">
        <div>
            <InputLabel for="email" value="Email" />

            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                autocomplete="username" />

            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">
            <InputLabel for="password" value="Password" />

            <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                autocomplete="current-password" />

            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="block mt-4">
            <label class="flex items-center">
                <Checkbox name="remember" v-model:checked="form.remember" />
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <Link v-if="canResetPassword" :href="route('password.request')"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Forgot your password?
            </Link>

            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Log in
            </PrimaryButton>
        </div>
    </form>  -->
</template>
