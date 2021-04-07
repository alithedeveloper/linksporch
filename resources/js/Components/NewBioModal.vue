<template>
    <div v-if="showCreateBioModal"
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
                    class="inline-block mx-5 relative align-bottom w-full bg-white rounded-md text-left overflow-y-auto shadow-xl transform transition-all
                           sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
                    <div class="bg-blue px-5 py-3 uppercase text-blue-100 text-sm font-semibold tracking-wider">
                        Create new profile
                    </div>

                    <form class="p-5" @submit.prevent="onFormSubmit">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Title
                            </label>
                            <div class="mt-1">
                                <input
                                    v-model="form.title"
                                    type="text" name="title" id="title"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full
                                    sm:text-sm text-gray-700 border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div class="mt-6 sm:mt-5 sm:space-y-5">
                            <div
                                class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="url" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Url
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <div class="max-w-lg flex rounded-md shadow-sm">
                                      <span
                                          class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-green bg-green text-white sm:text-sm">
                                        linkspor.ch/{{ username }}/
                                      </span>
                                        <input
                                            v-model="form.slug"
                                            type="text" name="slug" id="slug"
                                            class="flex-1 block w-full focus:ring-green focus:border-green min-w-0
                                            rounded-none rounded-r-md sm:text-sm text-gray-500 border-green">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="flex items-center mt-5">
                            <button
                                class="w-1/2 text-center uppercase tracking-wider relative px-8 py-2.5 border-2 border-indigo-600 text-sm
                                font-medium rounded text-indigo-50 focus:outline-none focus:ring-1 bg-indigo-700 hover:bg-indigo-600
                                focus:ring-indigo-800 focus:border-indigo-800"
                            >Create
                            </button>
                            <button
                                @click="onCancelBtnClick"
                                class="w-1/2 text-center ml-5 uppercase tracking-wider relative px-8 py-2.5 border-2 border-indigo-600 text-sm
                                font-medium rounded text-indigo-50 focus:outline-none focus:ring-1 bg-indigo-700 hover:bg-indigo-600
                                focus:ring-indigo-800 focus:border-indigo-800"
                            >Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import SelectIcon from "./Icons/SelectIcon";
import LoadingBeat from "./LoadingBeat";
import InlineSvg from "./InlineSvg";

export default {
    name: "NewBlogModal",
    components: {Notification, InlineSvg, LoadingBeat, SelectIcon},
    props: {
        showCreateBioModal: {
            type: Boolean,
            default: false
        }

    },
    data() {
        return {
            loading: false,
            form: this.$inertia.form({
                title: '',
                slug: ''
            })
        }
    },
    watch: {
        'form.title'(newValue) {
            this.form.slug = newValue.slugify('-')
        }
    },
    computed: {
        username() {
            return this.$page.props.user.username
        },
    },
    methods: {
        onCancelBtnClick() {
            this.$emit('update:show-create-bio-modal', !this.showCreateBioModal)
        },
        onClickOutside() {
            const notification = this.$root.$el.querySelector('.notification')
            if (this.showCreateBioModal === true && notification === null) {
                this.$emit('update:show-create-bio-modal', !this.showCreateBioModal)
            }
        },
        onFormSubmit() {
            this.form.post(route('bio.store'),{
                onSuccess: () => {

                },
                onError: () => {}
            })
        }
    },

}
</script>

<style>
.icon-tabler {
    width: 32px;
    height: 32px;
    stroke-width: 1.25;
}
</style>
