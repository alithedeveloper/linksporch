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
                                    <h1 class="flex-1 text-lg font-medium">Projects</h1>
                                    <div class="relative">
                                        <button type="button"
                                                class="w-full bg-white border border-gray-300 rounded-md shadow-sm px-4 py-2 inline-flex justify-center text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                id="sort-menu" aria-expanded="false" aria-haspopup="true">
                                            <!-- Heroicon name: solid/sort-ascending -->
                                            <svg class="mr-3 h-5 w-5 text-gray-400"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor" aria-hidden="true">
                                                <path
                                                    d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                            </svg>
                                            Sort
                                            <!-- Heroicon name: solid/chevron-down -->
                                            <svg class="ml-2.5 -mr-1.5 h-5 w-5 text-gray-400"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                        <!-- Dropdown menu, show/hide based on menu state. -->
                                        <div
                                            v-show="false"
                                            class="origin-top-right z-10 absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                            role="menu" aria-orientation="vertical" aria-labelledby="sort-menu">
                                            <div class="py-1" role="none">
                                                <a href="#"
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                   role="menuitem">Name</a>
                                                <a href="#"
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                   role="menuitem">Date modified</a>
                                                <a href="#"
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                   role="menuitem">Date created</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="relative z-0 divide-y divide-gray-200 border-b border-gray-200">
                               <bio-item v-for="bio in bios" :bio="bio" :key="bio.id"/>
                            </ul>
                        </div>
                    </div>

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

export default {
    components: {
        AppLayout,
        UserWelcomeBanner,
        DashboardStats,
        BioItem,
    },
    props: {
        bios: Object
    }
}
</script>
