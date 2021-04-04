<template>
    <div class="flex flex-col min-w-0 overflow-hidden">
        <div class="relative z-0 flex overflow-hidden">
            <section class="w-full lg:w-8/12 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
                <div class="bg-white px-6 flex items-center">
                    <inertia-link :href="route('bio.show',bioSlug)" class="border-b-2 mr-8 border-black inline-block px-2 py-4">Links</inertia-link>
                    <inertia-link :href="route('bio.appearance',bioSlug)" class="border-b-2 mr-8 border-black inline-block px-2 py-4">Appearance</inertia-link>
                    <a href="#" class="border-b-2 mr-8 border-black inline-block px-2 py-4">Settings</a>
                    <a href="#" class="border-b-2 mr-8 border-black inline-block px-2 py-4">Go Pro</a>
                </div>
                <slot></slot>
            </section>
            <aside class="hidden relative lg:flex lg:flex-col flex-shrink-0 fixed top-0 right-0 w-4/12 h-full border-l border-gray-200"
                   :style="modalIsOpen === true ? 'z-index:-1': 'z-index:1'">
                <!-- Start secondary column (hidden on smaller screens) -->
                <div class="bg-white px-6 flex items-center justify-between border-b-2 border-white">
                    <a href="#" class="py-4 block underline">{{ shareLink }}</a>
                    <share-button/>
                </div>

                <div class="flex items-center justify-center h-full bg-blue">
                    <div class="smartphone">
                        <div class="content">
                            <iframe
                                ref="iframe"
                                :src="`/dashboard/${username}/${bioSlug}/preview`"
                                style="visibility:hidden;width:100%;border:none;height:100%;pointer-events: none"
                                @load="iframeStyles"/>
                        </div>
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
            modalIsOpen: false
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
        },
    },
    methods:{
        iframeStyles(data){
            this.$refs.iframe.style.visibility = 'visible'
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
        this.$emitter.on('iframe', (payload) => {
            this.iframeStyles(payload)
        })
        this.$emitter.emit('iframeWindow', this.$refs.iframe.contentWindow)
        this.$emitter.on('modal-activation', ({show}) => {
           this.modalIsOpen = show
        })

    }
}
</script>

<style>
.smartphone {
    position: relative;
    width: 310px;
    height: 600px;
    margin: 20px auto 0;
    border: 12px #EFF6FF solid;
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
