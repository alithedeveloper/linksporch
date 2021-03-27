<template>
    <div
        class="min-h-screen"
        :class="bio.background"
    >
        <div class="flex flex-col max-w-xs mx-auto py-40">
            <a v-for="(link,index) in bio.links" :key="index"
               :href="link.url"
                class="border-2 border-green-100 p-2 mb-5 rounded mx-5
                       text-center shadow-sm bg-green-200"
            >{{ link.title }}</a>


        </div>
    </div>

</template>

<script>

export default {
    name: "View",
    components: {},
    props: ['user', 'bio']
}
</script>

<style>
nav {
    display: none;
}
.bg-green-500{
    background: #10B981;
}
.text-white{
    color: #ECFDF5;
}
</style>
