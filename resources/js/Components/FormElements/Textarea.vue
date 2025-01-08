<script setup>
import Error from "@/Components/Error/Error.vue";

defineProps(['modelValue', 'type', 'error', 'name', 'label', 'rows', 'placeholder', 'maxlength', 'required']);

defineEmits(['update:modelValue', 'validate']);
</script>

<template>
    <div  class="relative py-3" :class="[ 'form-control', !!error && 'has-error' ]">
        <label :for="name" class="px-2 block text-white text-sm font-medium absolute top-[3px] left-2 z-1 bg-black">
            {{ label }}
        </label>

        <textarea :id="name" :name="name" :rows="rows"
                  class="block w-full px-3 pt-3 pb-2.5 text-white border bg-black text-neutral rounded-lg focus:outline-none focus:ring-0 focus:border-blue"
                  @blur="$emit('validate')"
                  @focus="$emit('focus')"
                  :value="modelValue"
                  :required="required"
                  :placeholder="placeholder"
                  @input="$emit('update:modelValue', $event.target.value)"
                  ref="input" :maxlength="maxlength" :class="[!!error ? 'border-red' :  'border-white/50']"/>

        <Error :message="error"/>
    </div>
</template>
