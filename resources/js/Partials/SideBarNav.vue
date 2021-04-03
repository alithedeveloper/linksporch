<template>
    <nav aria-label="Sidebar" class="hidden md:block md:flex-shrink-0 md:bg-blue md:overflow-y-auto min-h-screen fixed h-full">
        <div class="relative w-20 h-full flex flex-col p-3 ">
            <div class="h-1/5 pt-1">
                <inertia-link :href="route('dashboard')" class="text-white flex-shrink-0 flex-col items-center justify-center h-14 w-14 rounded-lg">
                    <logo-icon classes=""/>
                    <p class="flex flex-col items-center pt-2 font-semibold leading-none">
                        <span class="block">Links</span>
                        <span class="block -mt-px ml-2.5">Posrch</span>
                    </p>
                </inertia-link>
                <div class="bg-white h-[2px] mt-5 w-full"></div>
            </div>


            <div class="h-3/5 flex flex-col items-center justify-center">
                <a href="#" class="text-gray-400 hover:bg-gray-700 flex-shrink-0 inline-flex items-center justify-center h-14 w-14 rounded-lg">
                    <span class="sr-only">Flagged</span>
                    <svg class="h-6 w-6" x-description="Heroicon name: outline/flag" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                    </svg>
                </a>

                <a href="#" class="text-gray-400 hover:bg-gray-700 flex-shrink-0 inline-flex items-center justify-center h-14 w-14 rounded-lg">
                    <span class="sr-only">Spam</span>
                    <svg class="h-6 w-6" x-description="Heroicon name: outline/ban" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                    </svg>
                </a>

                <a href="#" class="text-gray-400 hover:bg-gray-700 flex-shrink-0 inline-flex items-center justify-center h-14 w-14 rounded-lg">
                    <span class="sr-only">Drafts</span>
                    <svg class="h-6 w-6" x-description="Heroicon name: outline/pencil-alt" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </a>
            </div>

            <div class="h-1/5 h-full flex flex-col justify-end pb-10">
                <div class="bg-white h-[2px] mb-5 w-full"></div>
                <a href="#" class="flex-shrink-0 hover:bg-blue-dark inline-flex items-center justify-center h-14 w-14 rounded-lg">
                    <span class="sr-only">Flagged</span>
                    <chat-icon classes="w-7 h-7 text-blue-50" />
                </a>

                <a href="#" class="text-gray-400 hover:bg-blue-dark flex-shrink-0 inline-flex items-center justify-center h-14 w-14 rounded-lg">
                    <span class="sr-only">Spam</span>
                    <user-icon classes="w-7 h-7 text-blue-50"/>
                </a>
            </div>
        </div>
    </nav>
</template>

<script>
import LogoIcon from "../Components/Icons/LogoIcon";
import ChatIcon from "../Components/Icons/ChatIcon";
import UserIcon from "../Components/Icons/ProfileIcon";
export default {
    name: "SideBarNav",
    components: {UserIcon, LogoIcon, ChatIcon}
}
</script>

<style scoped>

</style>
