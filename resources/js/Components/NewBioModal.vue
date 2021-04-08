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
                    class="inline-block mx-5 relative align-bottom w-full bg-white rounded-lg text-left overflow-y-auto shadow-xl transform transition-all
                           sm:my-8 sm:align-middle sm:max-w-xl sm:w-full">
                    <div
                        class="bg-green px-5 py-3 sm:px-8 uppercase text-green-50 text-sm font-semibold tracking-wider sm:px-5 sm:py-3">
                        Create new profile
                    </div>

                    <form class="p-5 sm:px-8" @submit.prevent="onFormSubmit">
                        <div class="relative">
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Title
                            </label>
                            <div class="mt-1">
                                <input
                                    v-model="form.title"
                                    type="text" name="title" id="title"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full
                                    sm:text-sm text-gray-700 rounded-md"
                                    :class="bioErrors.title ? 'border-red-500':'border-gray-300'"
                                >
                            </div>
                            <p
                                v-if="bioErrors.title"
                                class="mt-0.5 ml-0.5 text-red-500"
                                >{{ bioErrors.title }}</p>
                        </div>
                        <div
                            class="w-full mt-5">
                            <label for="slug" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Url
                            </label>
                            <div class="mt-1">
                                <div class="flex rounded-md shadow-sm">
                                      <span
                                          class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-blue bg-blue text-white sm:text-sm">
                                        linkspor.ch/{{ username }}/
                                      </span>
                                    <input
                                        v-model="form.slug"
                                        type="text" name="slug" id="slug"
                                        class="flex-1 block w-full focus:ring-blue focus:border-green min-w-0
                                            rounded-none rounded-r-md sm:text-sm text-gray-500 "
                                        :class="bioErrors.slug ? 'border-red-500':'border-green'"
                                    >
                                </div>
                                <p
                                    v-if="bioErrors.slug"
                                    class="mt-0.5 ml-0.5 text-red-500"
                                >{{ bioErrors.slug }}</p>
                            </div>
                        </div>

                        <div class="flex items-center mt-8">
                            <button
                                @click="onCancelBtnClick"
                                class="w-1/2 text-center uppercase tracking-wider relative px-8 py-2.5 border-2 border-blue text-sm
                                font-medium rounded text-indigo-50 focus:outline-none focus:ring-2 bg-blue hover:bg-blue
                                focus:ring-blue focus:border-blue"
                            >Cancel
                            </button>
                            <button
                                class="w-1/2 text-center ml-5 uppercase tracking-wider relative px-8 py-2.5 border-2 border-green text-sm
                                font-medium rounded text-green-50 focus:outline-none focus:ring-2 bg-green focus:ring-green-dark
                                focus:border-green-dark"
                            >Create
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
            bioErrors: {},
            form: this.$inertia.form({
                title: '',
                slug: ''
            })
        }
    },
    watch: {
        'form.title'(newValue) {
            this.form.slug = newValue.slugify('-')
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
            this.$emit('update:show-create-bio-modal', !this.showCreateBioModal)
        },
        onClickOutside() {
            const notification = this.$root.$el.querySelector('.notification')
            if (this.showCreateBioModal === true && notification === null) {
                this.$emit('update:show-create-bio-modal', !this.showCreateBioModal)
            }
        },
        onFormSubmit() {
            this.form.post(route('bio.store'), {
                onSuccess: () => {
                    this.$emitter.emit('notify',{
                        type: 'success',
                        title: 'New profile is being created successfully'
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

<style>
.icon-tabler {
    width: 32px;
    height: 32px;
    stroke-width: 1.25;
}
</style>
