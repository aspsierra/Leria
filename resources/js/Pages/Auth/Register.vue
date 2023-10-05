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
    userName: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post('/register');
};

let step = ref(1);

</script>

<template>
    <Head title="Register" />
    <div class="hero min-h-screen bg-base-200">
        <div class="card flex-shrink-0 w-full max-w-md shadow-2xl bg-base-100">
            <form class="card-body" @submit.prevent="">
                <div v-show="step == 1">
                    <div class="form-control">
                        <InputLabel for="name" value="Nombre" />

                        <TextInput id="name" name="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                            autocomplete="name" placeHolder="Nombre" />

                        <InputError class="mt-2" :message="form.errors.userName" />
                    </div>
                    <div class="form-control mt-4">
                        <InputLabel for="surname" value="Apellidos" />

                        <TextInput id="surname" type="text" class="mt-1 block w-full" v-model="form.surname"
                            autocomplete="surname" placeHolder="Apellidos" />

                        <InputError class="mt-2" :message="form.errors.surname" /> 
                    </div>
                </div>

                <div v-show="step == 2">
                    <div class="form-control">
                        <InputLabel for="userName" value="Nombre de usuario" />

                        <TextInput id="userName" type="text" class="mt-1 block w-full" v-model="form.userName" required
                            autocomplete="username" placeHolder="Nombre de usuario" />

                         <InputError class="mt-2" :message="form.errors.userName" /> 
                    </div>
                    <div class="form-control mt-4">
                        <InputLabel for="email" value="Email" />

                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="username" placeHolder="ejemplo@email.com" />

                        <InputError class="mt-2" :message="form.errors.email" /> 
                    </div>
                </div>

                <div v-show="step == 3">
                    <div class="form-control">
                        <InputLabel for="password" value="Contraseña" />

                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                            autocomplete="current-password" placeHolder="Contraseña" />

                         <InputError class="mt-2" :message="form.errors.password" /> 

                    </div>
                    <div class="form-control mt-4">
                        <InputLabel for="password_confirmation" value="Repite tu contraseña" />

                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation"
                            required autocomplete="current-password-confirm" placeHolder="Contraseña" />

                         <InputError class="mt-2" :message="form.errors.password_confirmation" /> 

                    </div>
                </div>
                <div class="flex flex-row w-1/3 content-between mt-4">
                    <button class="btn btn-secondary w-full" :class="step == 1 ? 'btn-disabled' : 'btn-active'"
                    @click="step--">Atrás</button>
                    
                    <button v-if="step == 3" class="btn btn-primary w-full" @click="submit">Registrar</button>
                    <button v-else class="btn btn-primary w-full" :class="step >= 3 ? 'btn-disabled' : 'btn-active'"
                        @click="step++">Continuar</button> 
                </div>
            </form>

            <div class="card-body">
                <ul class="steps">
                    <li class="step step-primary"></li>
                    <li class="step"></li>
                    <li class="step"></li>
                    <li class="step"></li>
                </ul>
            </div>
            <div class="card-body pt-0 flex w-full">
                <p>¿Ya tienes una cuenta?</p>
                <Link href="/login" class="btn btn-secondary">Entrar</Link>
            </div>
        </div>

    </div>


    <!-- <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form> -->
</template>
