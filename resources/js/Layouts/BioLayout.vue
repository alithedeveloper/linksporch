<template>
    <div class="flex flex-col min-w-0 flex-1 overflow-hidden">
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <section class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
                <div class="bg-white px-6 flex items-center">

                    <inertia-link :href="route('bio.show',bioSlug)" class="border-b-2 mr-8 border-black inline-block px-2 py-4">Links</inertia-link>
                    <inertia-link :href="route('bio.appearance',bioSlug)" class="border-b-2 mr-8 border-black inline-block px-2 py-4">Appearance</inertia-link>
                    <a href="#" class="border-b-2 mr-8 border-black inline-block px-2 py-4">Settings</a>
                    <a href="#" class="border-b-2 mr-8 border-black inline-block px-2 py-4">Go Pro</a>
                </div>
                <slot></slot>
            </section>
            <aside class="hidden relative xl:flex xl:flex-col flex-shrink-0 w-5/12 border-l border-gray-200 z-[-1]">
                <!-- Start secondary column (hidden on smaller screens) -->
                <div class="bg-white px-6 flex items-center justify-between border-b-2 border-white">
                    <a href="#" class="py-4 block underline">{{ shareLink }}</a>
                    <share-button/>
                </div>


                <div class="smartphone">
                    <div class="content">
                        <iframe
                            ref="iframe"
                            :src="`/${username}/${bioSlug}`"
                               style="width:100%;border:none;height:100%" @load="iframeStyles"/>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</template>

<script>

import ShareButton from "@/Components/ShareButton";

export default {
    name: "BioLayout",
    components: {
        ShareButton
    },
    data(){
        return{
            frame: null,
        }
    },
    computed:{
       username(){
           return this.$page.props.user.username
       },
        bioSlug(){
           return this.$page.props.bio.slug
        },
        shareLink(){
           return this.$page.props.bio.url
        }
    },
    methods:{
        iframeStyles(data){
             data = JSON.stringify(data)
            // const style =
            //     '.layout__wrapper {background:red;} ' +
            //     'body {background: red !important;} '
            // let data = {
            //     style: 'layout-2',
            //     text: 'This will be long text'
            // };

            // this.frame.postMessage(text, '*')
            this.frame.postMessage(data, '*');

        },
    },
    mounted() {
        this.frame = this.$refs.iframe.contentWindow
        this.$emitter.on('reload', () => {
            this.$refs.iframe.contentWindow.location.reload()
        })
        this.$emitter.on('iframe', (payload) => {
            this.iframeStyles(payload)
        })
        this.$emitter.emit('iframeWindow', this.$refs.iframe.contentWindow)

    }
}
</script>

<style>
.smartphone {
    position: relative;
    width: 310px;
    height: 600px;
    margin: 20px auto 0;
    border: 12px black solid;
    border-radius: 36px;
    overflow: hidden;
    overflow-y: auto;
}





/* The screen (or content) of the device */
.smartphone .content {
    width: 100%;
    height: 100%;
    background: white;
}
</style>
