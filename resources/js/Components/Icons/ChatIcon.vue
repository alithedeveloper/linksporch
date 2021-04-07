<template>
    <svg viewBox="0 0 512 512" :class="classes" class="fill-current">
        <path d="M432 0H80C35.817 0 0 35.817 0 80v256c0 44.183 35.817 80 80 80h313.44l91.2 91.36A15.999 15.999 0 00496 512c8.837 0 16-7.163 16-16V80c0-44.183-35.817-80-80-80zm48 457.44l-68.64-68.8A15.997 15.997 0 00400 384H80c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48v377.44z"/>
        <circle cx="256" cy="208" r="32"/>
        <circle cx="368" cy="208" r="32"/>
        <circle cx="144" cy="208" r="32"/>
    </svg>
</template>

<script>
export default {
    name: "ChatIcon",
    props: {
        classes: {
            type: String,
            default: ''
        }
    }
}
</script>

<style scoped>

</style>
