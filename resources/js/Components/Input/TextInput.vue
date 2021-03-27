<template>
    <div class="input-group relative w-full">
        <label :for="`url-${data.id}`" class="sr-only">{{ normalizedName }}</label>
        <input type="text"
               name="url"
               :value="modelValue"
               :id="`url-${data.id}`"
               @input="$emit('update:modelValue',$event.target.value)"
               @keydown.enter="persist(name)"
               class="w-full block text-sm border-1 rounded py-1 px-2 leading-none
                      appearance-none focus:ring-0 bottom-0 my-2"
               :class="error ? 'border-red-300 focus:ring-red-200' : 'border-gray-300 focus:ring-1 focus:ring-indigo-200'"
               placeholder="Url">
        <p class="absolute right-0 text-xs leading-none text-red-600" v-if="error">
            {{ error }}
        </p>
    </div>
</template>

<script>
import CancelIcon from "@/Components/Icons/CancelIcon";
import CheckIcon from "@/Components/Icons/CheckIcon";

export default {
    name: "TextInput",
    emits: ['keydown.enter:input', 'update:modelValue'],
    components: {
        CancelIcon,
        CheckIcon
    },
    props: {
        data: {
            type: Object,
            default: null
        },
        modelValue: {
            type: String,
            default: ''
        },
        persist: {
            type: Function,
            default: () => {
            }
        },
        name: {
            type: String,
            default: null
        },
        error: String,
    },
    computed: {
        normalizedName() {
            // url becomes Url
            return this.name.charAt(0).toUpperCase() + this.name.slice(1)
        }
    }

}
</script>

<style scoped>

</style>
