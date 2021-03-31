<template>
    <button
        type="button"
        class="w-full items-center justify-center inline-block px-4 py-2 font-medium border border-transparent
        rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 sm:text-sm"
        @click="$emit('clicked')"
        :class="classes"
    >
        <slot></slot>
    </button>
</template>

<script>
export default {
    name: "ButtonInput",
    props: {
        linkType: {
            type: String,
            default: ''
        },
        classes: {
            type: String,
            default: ''
        },
        clicked: {
            type: Function,
            default: () => {
            }
        }
    }
}
</script>

<style scoped>

</style>
