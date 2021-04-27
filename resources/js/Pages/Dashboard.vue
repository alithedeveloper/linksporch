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
                        <div class="lg:min-w-0">
                            <div
                                class="pl-4 pr-6 pt-4 pb-4 sm:pl-6 lg:pl-8 xl:pl-6 xl:pt-6">
                                <div class="flex items-center">
                                    <h1 class="flex-1 text-lg font-medium">Your Current Porchs</h1>
                                    <div class="relative">
                                        <button
                                                @click="onClickAddNewBio"
                                                type="button"
                                                class="w-full flex items-center bg-white border-2 border-green rounded-md shadow-sm p-4
                                                bg-green inline-flex justify-center text-sm font-medium text-blue-50 hover:bg-white
                                                hover:text-green focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green"
                                        >
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        <span class="inline-block ml-2">Create new Porch</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="relative z-0 bg-white mt-5 p-5">
                               <bio-item v-for="bio in bios" :bio="bio" :key="bio.id"/>
                            </ul>
                        </div>
                    </div>
                    <new-bio-modal
                        v-model:show-create-bio-modal="showCreateBioModal"
                        :errors="errors"
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
        bios: Object,
        errors:{
            type: Object
        }
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
