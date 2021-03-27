<template>
    <text-input name="title"
                :error="error"
                :data="data"
                :persist="persist"
                v-model="linkTitle"
    />

    <span
        @click="persist('title')"
        class="block ml-2 cursor-pointer tab-index"><check-icon
        classes="w-6 h-6 text-gray-500"></check-icon> </span>
    <span
        @click="isEditingLinkTitle"
        class="block ml-2 cursor-pointer"><cancel-icon
        classes="w-6 h-6 text-gray-500"></cancel-icon> </span>
</template>

<script>
import TextInput from "@/Components/Input/TextInput";
import CheckIcon from "@/Components/Icons/CheckIcon";
import CancelIcon from "@/Components/Icons/CancelIcon";

export default {
    name: "LinkTitle",
    emits:['update:title','update:is-editing-title'],
    props: {
        error: String,
        name: String,
        data: Object,
        persist: Function,
        title: String,
        isEditingTitle: Boolean,

    },
    components: {
        TextInput,
        CheckIcon,
        CancelIcon
    },
    computed:{
        linkTitle: {
            get() { return this.title},
            set(linkTitle) { this.$emit('update:title', linkTitle)}
        },
    },
    methods:{
        isEditingLinkTitle(){
            this.$emit('update:is-editing-title', !this.isEditingTitle)
        }
    }

}
</script>

<style scoped>

</style>
