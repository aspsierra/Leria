<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
    message: String
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template class="flex">
    <div class="flex">
        <input
            type="checkbox"
            :value="value"
            v-model="proxyChecked"
            class="toggle toggle-primary"
        />
        <span class="ml-2 text-sm">{{ message }}</span>
    </div>
</template>
