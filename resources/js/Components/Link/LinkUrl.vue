<template>
    <text-input name="url"
                :error="error"
                :data="data"
                :persist="persist"
                v-model="linkUrl"
    />

    <span
        @click="persist('url')"
        class="block ml-2 cursor-pointer tab-index"><check-icon
        classes="w-6 h-6 text-gray-500"></check-icon> </span>
    <span
        @click="isEditingLinkUrl"
        class="block ml-2 cursor-pointer"><cancel-icon
        classes="w-6 h-6 text-gray-500"></cancel-icon> </span>
</template>

<script>
import TextInput from "@/Components/Input/TextInput";
import CheckIcon from "@/Components/Icons/CheckIcon";
import CancelIcon from "@/Components/Icons/CancelIcon";

export default {
    name: "LinkUrl",
    emits:['update:url','update:is-editing-url'],
    props: {
        error: String,
        name: String,
        data: Object,
        persist: Function,
        url: String,
        isEditingUrl: Boolean,

    },
    components: {
        TextInput,
        CheckIcon,
        CancelIcon
    },
    computed:{
        linkUrl: {
            get() { return this.url},
            set(linkUrl) { this.$emit('update:url', linkUrl)}
        },
    },
    methods:{
        isEditingLinkUrl(){
            this.$emit('update:is-editing-url', !this.isEditingUrl)
        }
    }

}
</script>

<style scoped>

</style>
