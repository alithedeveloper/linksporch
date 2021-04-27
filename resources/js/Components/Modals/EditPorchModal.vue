<template>
    <div v-if="show"
         class="fixed z-40 inset-0 overflow-y-auto"
         aria-labelledby="modal-title" role="dialog"
         aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <transition
                enter-active-class="ease-out duration-300"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="ease-in duration-200"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                     tabindex="0"
                     aria-hidden="true"
                     @keydown.esc="$emit('update:showIcons', !showIcons)"></div>
            </transition>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <transition
                enter-active-class="ease-out duration-300"
                enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                leave-active-class="ease-in duration-200"
                leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <div
                    v-click-outside="onClickOutside"
                    class="inline-block mx-5 relative align-bottom w-full bg-white rounded text-left overflow-y-auto shadow-xl transform transition-all
                           sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <header
                        class="flex items-center justify-between bg-gray-100 px-5 py-4 sm:px-8 sm:px-5 sm:py-3">
                        <div class="flex items-center">
                            <span class="inline-block w-3 h-3 bg-red-600 rounded-full"></span>
                            <span class="inline-block w-3 h-3 ml-1.5 bg-green rounded-full"></span>
                            <span class="inline-block w-3 h-3 ml-1.5 bg-blue rounded-full"></span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-6 bg-gray-300 rounded flex items-center justify-center text-gray-50">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </div>
                            <div class="w-10 h-6 bg-gray-300 rounded flex items-center justify-center text-gray-50 ml-1">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </header>

                    <form class="p-5 sm:px-8" @submit.prevent="onFormSubmit">


                        <div class="relative">
                            <label for="title" class="pl-1 block text-xs font-medium text-gray-400">
                                Change your porch name
                            </label>
                            <div class="mt-2">
                                <input
                                    v-model="form.title"
                                    type="text" name="title" id="title"
                                    class="shadow-sm focus:ring-blue focus:border-blue block w-full
                                    sm:text-sm text-gray-600 rounded-md"
                                    :class="bioErrors.title ? 'border-red-500':'border-gray-200'"
                                >
                            </div>
                            <p
                                v-if="bioErrors.title"
                                class="mt-0.5 ml-0.5 text-red-500"
                            >{{ bioErrors.title }}</p>
                        </div>

                        <div
                            class="w-full mt-5">
                            <label for="slug"
                                   class="pl-1 block text-xs font-medium text-gray-400">
                                Change your porch link
                            </label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm">
                                      <span
                                          class="inline-flex text-gray-400 items-center px-3 rounded-l-md border border-r-0 sm:text-sm">
                                        linkspor.ch/{{ username }}/
                                      </span>
                                    <input
                                        v-model="form.slug"
                                        type="text" name="slug" id="slug"
                                        class="flex-1 block w-full focus:ring-blue focus:border-blue min-w-0
                                            rounded-none rounded-r-md sm:text-sm text-gray-600 "
                                        :class="bioErrors.slug ? 'border-red-500':'border-gray-200'"
                                    >
                                </div>
                                <p
                                    v-if="bioErrors.slug"
                                    class="mt-0.5 ml-0.5 text-red-500"
                                >{{ bioErrors.slug }}</p>
                            </div>
                        </div>

                        <div class="relative mt-5">
                            <label for="leapUrl" class="pl-1 block text-xs font-medium text-gray-400">
                                Redirect user to a custom domain
                            </label>
                            <div class="mt-2">
                                <input
                                    v-model="form.leapUrl"
                                    placeholder="https://www.example.com"
                                    type="text" name="leapUrl" id="leapUrl"
                                    class="shadow-sm focus:ring-blue focus:border-blue block w-full
                                    placeholder-gray-500 placeholder-opacity-50
                                    sm:text-sm text-gray-700 rounded-md border-gray-200"
                                >
                            </div>
                        </div>

                        <div class="block h-1 border-b border-gray-200 mt-10"></div>
                        <div class="flex items-center justify-between mt-5">
                            <button
                                type="button"
                                @click="onCancelBtnClick"
                                class="inline-block text-center uppercase tracking-wider relative px-5 py-2 border border-blue
                                text-xs text-blue font-medium rounded text-indigo-50 focus:outline-none focus:ring-2 bg-white
                                hover:bg-blue hover:text-blue-50 focus:ring-blue focus:border-blue"
                            >Never mind
                            </button>
                            <button
                                class="inline-block text-center ml-5 uppercase tracking-wider relative px-5 py-2
                                border border-green text-xs font-medium rounded text-green hover:bg-green
                                hover:text-green-50 focus:outline-none focus:ring-green focus:border-green"
                            >Update Porch
                            </button>
                        </div>
                    </form>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>

export default {
    name: "EditPorchModal",
    components: {},
    props: {
        show: {
            type: Boolean,
            default: false
        },
        bio: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            loading: false,
            bioErrors: {},
            form: this.$inertia.form({
                title: this.bio.title,
                slug: this.bio.slug,
                leapUrl: this.bio.leap_url
            })
        }
    },
    watch: {
        'form.title'(newValue) {
            let slug = newValue.slugify('-')
            if (this.form.slug !== slug){
                this.form.slug = slug
            }
            if (newValue.length) this.bioErrors = {}
        }
    },
    computed: {
        username() {
            return this.$page.props.user.username
        },
    },
    methods: {
        onCancelBtnClick() {
            this.$emit('update:show', !this.show)
        },
        onClickOutside() {
            const notification = this.$root.$el.querySelector('.notification')
            if (this.show === true && notification === null) {
                this.$emit('update:show', !this.show)
            }
        },
        onFormSubmit() {
            this.form.put(route('bio.update',{ bio: this.bio.slug}), {
                onSuccess: () => {
                    this.$emitter.emit('notify',{
                        type: 'success',
                        title: 'Porch has been updated'
                    })
                },
                onError: (errors) => {
                    this.bioErrors = errors
                }
            })
        }
    }

}
</script>


