<template>
    <app-layout>
        <bio-layout>
            <div class="inset-0 px-4 sm:px-6 lg:px-0 xl:px-8 mt-14 mb-60 max-w-4xl mx-auto">
                <div class="flex flex-col items-center lg:px-32">

                    <form class="w-full" @submit.prevent="onCreateLinkSubmit">
                        <button
                            type="submit" class="text-center w-full inline-flex items-center justify-center px-4 py-3 border
                                 border-transparent text-base leading-6 font-medium rounded-md text-white bg-green
                                 hover:bg-green-dark focus:border-indigo-700 active:bg-green-dark focus:outline-none
                                 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150
                                 cursor-pointer" :disabled="processing">
                            <plus-icon v-if="!processing" classes="w-4 h-4 mr-2" />
                            <svg v-show="processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="text-lg font-semibold" v-if="processing">Processing</span>
                            <span class="text-lg font-semibold" v-else>Add New Link</span>
                        </button>
                    </form>


                </div>
                <div class="mt-5">
                    <div class="lg:px-32" id="bio-links">
                        <link-item v-for="link in bio.links"
                                   :link="link"
                                   :svgs="svgs"
                                   :key="link.id"/>
                    </div>
                </div>
            </div>
        </bio-layout>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BioLayout from "@/Layouts/BioLayout"
import LinkItem from "@/Components/LinkItem"
import ShareButton from "@/Components/ShareButton"
import PlusIcon from "../../Components/Icons/PlusIcon";


export default {
    name: "Show",
    components: {
        PlusIcon,
        AppLayout,
        BioLayout,
        LinkItem,
        ShareButton,
    },
    props: {
        bio: {
            type: Object,
            default: {}
        },
        errors: {
            type: Object,
            default: {}
        },

    },
    data(){
        return{
            processing: false,
            svgs:[],
        }
    },
    methods: {
        onCreateLinkSubmit() {
            this.$inertia.post(this.route('link.create', this.bio.slug), {},{
                preserveScroll: true,
                onStart: () => this.processing = true,
                onSuccess: () => {
                    this.processing = false
                    this.$emitter.emit('reload')
                }
            })
        }
    },
    created() {
        return axios.get('/api/svgs')
            .then(({data}) => {
                this.svgs = data.svgs
            })

    }
}
</script>

<style scoped>

</style>
