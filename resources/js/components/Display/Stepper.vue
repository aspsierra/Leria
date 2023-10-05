<script setup>

import { Link } from '@inertiajs/vue3';

const props = defineProps({
    currentStep: Number,
    totalSteps: Number,
    error: Array
})

const emits = defineEmits({
    n: Number
})


function classType(n, currentStep, error) {
    let name = ''
    n <= currentStep ? name = 'step-primary ' : name = ''
    error != -1 ? name += 'step-error ' : name += ''
    return name
}

</script>

<template>
    <ul class="steps">
        <li class="step cursor-pointer" v-for="n in totalSteps" :class="classType(n, currentStep, error.indexOf(n))"
            :data-content="error.indexOf(n) != -1 ? '!' : n" @click="$emit('select-step', n)">
        </li>
    </ul>
</template>