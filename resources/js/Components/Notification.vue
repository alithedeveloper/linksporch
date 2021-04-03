<template>

    <div
        class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end z-10">

        <transition
            enter-active-class="transform ease-out duration-300 transition"
            leave-active-class="transition ease-in duration-100"
            enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            leave-to-class="opacity-0"
            enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
            leave-from-class="opacity-100"
        >
            <div v-if="showNotification"
                 class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                <div class="p-4 notification">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">

                            <svg v-if="type==='success'"
                                 class="h-6 w-6 text-green-400"  fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>

                            <svg v-if="type==='error'" class="h-6 w-6 text-red-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>


                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-gray-900">
                                {{ title }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500">
                                {{ message }}
                            </p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button
                                @click="showNotification=false"
                                class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span class="sr-only">Close</span>
                                <!-- Heroicon name: solid/x -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                     fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    name: "Notification",
    data() {
        return {
            showNotification: false,
            title:null,
            message:null,
            type: 'success'
        }
    },
    computed:{
        notificationType(){
            return this.type
        }
    },
    mounted() {

        this.$emitter.on('notify', (payload) => {
            this.showNotification = true
            if (payload.type) this.type = payload.type
            this.title = payload.title
            this.message=payload.message
        })

    }
}
</script>

<style scoped>

</style>
