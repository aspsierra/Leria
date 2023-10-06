<script setup>

const props = defineProps({
    placeholder: String
})

</script>

<template>
    <div class="form-control">
        <input type="text" :placeholder="placeholder" class="input input-bordered w-24 md:w-auto" />
    </div>
</template>