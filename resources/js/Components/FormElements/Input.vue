<script setup>
import { onMounted, ref } from 'vue';
import Error from "@/Components/Error/Error.vue";
defineProps(['modelValue', 'name', 'type', 'error', 'label', 'min', 'max', 'maxlength', 'placeholder', 'disabled', 'autofocus', 'loading', 'autocomplete', 'required', 'ref']);

defineEmits(['update:modelValue', 'validate']);

const input = ref(null);


// onMounted(() => {
//    console.log(this.error, this.id);
// });
</script>

<template>
    <div class="w-full relative py-3" :class="[ 'form-control', !!error && 'has-error' ]">
        <label :for="name" class="px-2 block text-white text-[13px] font-medium absolute top-[3px] left-2 z-1 bg-black">
            {{ label }}
        </label>

        <input
            :id="name"
            :name="name"
            :type="type"
            :min="min"
            :max="max"
            :maxlength="maxlength"
            :disabled="disabled"
            :autocomplete="autocomplete"
            :required="required"
            :placeholder="placeholder"
            @blur="$emit('validate')"
            @focus="$emit('focus')"
            :value="modelValue"
            :ref="ref"
            @input="$emit('update:modelValue', $event.target.value)"
            class="block w-full px-3 pt-3 pb-2.5 text-base border bg-black text-white rounded-lg focus:outline-none focus:ring-0 focus:border-blue"
            :class="[!!error ? 'border-red' :  'border-white/50']"/>

        <div class="block w-6 h-6 border-2 rounded-full border-t-white border-gray-light animate-spin loading-icon" v-if="loading"></div>

        <Error :message="error"/>
    </div>
</template>

<style scoped>
::-webkit-calendar-picker-indicator {
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 24 24"><path fill="%23bbbbbb" d="M20 3h-1V1h-2v2H7V1H5v2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H4V8h16v13z"/></svg>');
}

input[type=date]{
    height: 50px;
    line-height: normal !important;
}

input::placeholder{
    @apply text-white/50
}


.loading-icon {
    position: absolute;
    top: 23px;
    right: 15px;
}
</style>
