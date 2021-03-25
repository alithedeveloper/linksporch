<template>
    <svg viewBox="0 0 512 512" :class="classes" class="fill-current">
        <path d="M452 512H60c-33.086 0-60-26.914-60-60V60C0 26.914 26.914 0 60 0h392c33.086 0 60 26.914 60 60v392c0 33.086-26.914 60-60 60zM60 40c-11.027 0-20 8.973-20 20v392c0 11.027 8.973 20 20 20h392c11.027 0 20-8.973 20-20V60c0-11.027-8.973-20-20-20zm370.898 111.344l-29.8-26.688-184.965 206.567L108.78 229.176l-27.558 28.988L218.44 388.61zm0 0"/>
    </svg>
</template>

<script>
export default {
    name: "CheckIcon",
    props: {
        classes: {
            type: String,
            default: 'fill-current'
        }
    }
}
</script>

