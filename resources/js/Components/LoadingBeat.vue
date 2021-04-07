<template>
    <div class="flex w-full items-center justify-center">
        <div class="lds-facebook flex items-center"><div></div><div></div><div></div></div>
    </div>

</template>

<script>
export default {
    name: "LoadingBeat",
    props:{
        classes: {
            type: String,
            default: ''
        }
    }
}
</script>

<style>
.lds-facebook {
    display: inline-block;
    position: relative;
    width: 40px;
    height: 80px;
    margin: 0 auto;
}
.lds-facebook div {
    display: inline-block;
    position: absolute;
    left: 8px;
    width: 16px;
    background: #50A0FF;
    animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
}
.lds-facebook div:nth-child(1) {
    left: 8px;
    animation-delay: -0.24s;
}
.lds-facebook div:nth-child(2) {
    left: 32px;
    animation-delay: -0.12s;
}
.lds-facebook div:nth-child(3) {
    left: 56px;
    animation-delay: 0;
}
@keyframes lds-facebook {
    0% {
        top: 8px;
        height: 64px;
    }
    50%, 100% {
        top: 24px;
        height: 32px;
    }
}
</style>
