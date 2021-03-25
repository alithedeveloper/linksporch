<template>
    <app-layout>
        <bio-layout>
            <div class="inset-0 px-4 sm:px-6 lg:px-8 mt-14 mb-60">
                <div class="flex lg:px-32">
                    <button
                        type="button"
                        class="block w-full px-5 py-3 border border-transparent text-lg font-semibold tracking-wide rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-center">
                        Add new link
                    </button>

                </div>
                <div class="mt-5">
                    <ul class="lg:px-32 space-y-5" id="bio-links">
                        <link-item v-for="link in bio.links" :link="link" :key="link.id" :errors="errors"/>
                    </ul>
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


export default {
    name: "Show",
    components: {
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
            default:{}
        }
    },
    mounted() {
        console.table(this.bio.links)
    }
}
</script>

<style scoped>

</style>
