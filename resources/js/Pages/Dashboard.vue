<template>
    <app-layout>

        <div class="h-screen flex overflow-hidden bg-gray-100">

            <!-- Static sidebar for desktop -->

            <div class="flex-1 overflow-auto focus:outline-none" tabindex="0">

                <main class="flex-1 relative pb-8 z-0 overflow-y-auto">
                    <!-- Page header -->

                    <user-welcome-banner/>

                    <div class="mt-8 space-y-8 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                        <dashboard-stats/>
                        <!-- Projects List -->
                        <div class="bg-white lg:min-w-0">
                            <div
                                class="pl-4 pr-6 pt-4 pb-4 border-b border-t border-gray-200 sm:pl-6 lg:pl-8 xl:pl-6 xl:pt-6 xl:border-t-0">
                                <div class="flex items-center">
                                    <h1 class="flex-1 text-lg font-medium">Your Bios</h1>
                                    <div class="relative">
                                        <button
                                                @click="onClickAddNewBio"
                                                type="button"
                                                class="w-full flex items-center bg-white border border-blue-light rounded-md shadow-sm px-4 py-2
                                                bg-blue inline-flex justify-center text-sm font-medium text-blue-50 hover:bg-blue-dark
                                                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-dark"
                                        >
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        <span class="inline-block ml-2">Create a new bio</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="relative z-0 divide-y divide-gray-200 border-b border-gray-200">
                               <bio-item v-for="bio in bios" :bio="bio" :key="bio.id"/>
                            </ul>
                        </div>
                    </div>
                    <new-bio-modal
                        v-model:show-create-bio-modal="showCreateBioModal"
                    />

                </main>
            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import UserWelcomeBanner from "@/Components/UserWelcomeBanner";
import DashboardStats from "@/Components/DashboardStats";
import BioItem from "@/Components/BioItem";
import NewBioModal from "../Components/NewBioModal";

export default {
    components: {
        AppLayout,
        UserWelcomeBanner,
        DashboardStats,
        BioItem,
        NewBioModal,
    },
    props: {
        bios: Object
    },
    data(){
        return{
            showCreateBioModal : false
        }
    },
    methods:{
        onClickAddNewBio(){
           this.showCreateBioModal = !this.showCreateBioModal
        }
    }
}
</script>
