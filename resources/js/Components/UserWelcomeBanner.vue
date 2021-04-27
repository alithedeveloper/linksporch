<template>
    <div>
        <div class="px-4 sm:px-6 lg:max-w-6xl lg:mx-auto lg:px-8">
            <div class="grid grid-cols-12 gap-5 min-w-0 mt-4">
                <!-- Profile -->
                <div class="col-span-5 flex items-center p-6 rounded shadow bg-white">
                    <img class="hidden h-24 w-24 rounded-full sm:block" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=egjrLdcwJo&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.6&w=256&h=256&q=80" alt="">
                    <div>
                        <div class="flex items-center">
                            <img class="h-16 w-16 rounded-full sm:hidden" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=egjrLdcwJo&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.6&w=256&h=256&q=80" alt="">
                            <h1 class="ml-8 text-xl leading-7 text-gray-900 sm:leading-9 sm:truncate">
                                Hello, Emilia Birch
                            </h1>
                        </div>
                        <dl class="mt-6 flex flex-col sm:ml-8 sm:mt-1 sm:flex-row sm:flex-wrap">
                            <dt class="sr-only">Account status</dt>
                            <dd class="mt-3 flex items-center text-sm text-gray-500 font-medium sm:mr-6 sm:mt-0 capitalize">
                                <!-- Heroicon name: solid/check-circle -->
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Verified account
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="col-span-3 bg-green">Hwello</div>
                <div class="col-span-4 bg-blue">Ok</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "UserWelcomeBanner"
}
</script>

<style scoped>

</style>
