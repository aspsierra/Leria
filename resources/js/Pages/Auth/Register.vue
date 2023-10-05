<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Stepper from '@/Components/Display/Stepper.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, shallowRef} from 'vue';
import { onBeforeUpdate } from 'vue';
import { onMounted } from 'vue';

const form = useForm({
    name: '',
    surname: '',
    userName: '',
    email: '',
    password: '',
    password_confirmation: '',
});

let step = ref(1)
let errorStep = ref([]);
onBeforeUpdate(()=>{
    
    if (form.hasErrors) {
        if (form.errors.name && errorStep.value.indexOf(1) == -1) {
            errorStep.value.push(1);
        }
        if ((form.errors.userName || form.errors.email) && errorStep.value.indexOf(2) == -1) {
            errorStep.value.push(2);
        } 
        if ((form.errors.password || form.errors.password_confirmation)  && errorStep.value.indexOf(3) == -1) {
            errorStep.value.push(3);
        }
    }
    //console.log(errorStep.indexOf(1));
})



const submit = () => {
    form.post('/register');
};

</script>

<template>
    <Head title="Register" />
    <div class="hero min-h-screen bg-base-200">
        <div class="card flex-shrink-0 w-full max-w-screen-sm sm:max-w-md   shadow-2xl bg-base-100">
            <form class="card-body" @submit.prevent="">
                <div v-show="step == 1">
                    <div class="form-control">
                        <InputLabel for="name" value="Nombre" />

                        <TextInput id="name" name="name" type="text" class="mt-1 block w-full"
                            :class="form.errors.name ? 'input-error' : ''" v-model="form.name" required autocomplete="name"
                            placeHolder="Nombre" />

                        <InputError class="mt-2 min-h-6" :message="form.errors.name" />
                    </div>
                    <div class="form-control mt-4">
                        <InputLabel for="surname" value="Apellidos" />

                        <TextInput id="surname" type="text" class="mt-1 block w-full"
                            :class="form.errors.surname ? 'input-error' : ''" v-model="form.surname" autocomplete="surname"
                            placeHolder="Apellidos" />

                        <InputError class="mt-2 min-h-6" :message="form.errors.surname" />
                    </div>
                </div>

                <div v-show="step == 2">
                    <div class="form-control">
                        <InputLabel for="userName" value="Nombre de usuario" />

                        <TextInput id="userName" type="text" class="mt-1 block w-full" v-model="form.userName"
                            :class="form.errors.userName ? 'input-error' : ''" required autocomplete="username"
                            placeHolder="Nombre de usuario" />

                        <InputError class="mt-2 min-h-6" :message="form.errors.userName" />
                    </div>
                    <div class="form-control mt-4">
                        <InputLabel for="email" value="Email" />

                        <TextInput id="email" type="email" class="mt-1 block w-full"
                            :class="form.errors.email ? 'input-error' : ''" v-model="form.email" required
                            autocomplete="username" placeHolder="ejemplo@email.com" />

                        <InputError class="mt-2 min-h-6" :message="form.errors.email" />
                    </div>
                </div>

                <div v-show="step == 3">
                    <div class="form-control">
                        <InputLabel for="password" value="Contraseña" />

                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                            :class="form.errors.password ? 'input-error' : ''" required autocomplete="current-password"
                            placeHolder="Contraseña" />

                        <InputError class="mt-2 min-h-6" :message="form.errors.password" />

                    </div>
                    <div class="form-control mt-4">
                        <InputLabel for="password_confirmation" value="Repite tu contraseña" />

                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                            :class="form.errors.password_confirmation ? 'input-error' : ''"
                            v-model="form.password_confirmation" required autocomplete="current-password-confirm"
                            placeHolder="Contraseña" />

                        <InputError class="mt-2 min-h-6" :message="form.errors.password_confirmation" />

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
                <Stepper :currentStep="step" :totalSteps='3' :error="errorStep" @select-step="(n) => step = n" />
            </div>
            <div class="card-body divider my-0 py-4">O</div>
            <div class="card-body pt-0 flex w-full">
                <p>¿Ya tienes una cuenta?</p>
                <Link href="/login" class="btn btn-secondary">Entrar</Link>
            </div>
        </div>

    </div>
</template>
