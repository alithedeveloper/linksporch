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
                    class="inline-block mx-5 relative align-bottom w-full bg-white rounded text-left overflow-y-auto shadow-xl transform transition-all
                           sm:my-8 sm:align-middle sm:max-w-xl sm:w-full">
                    <header
                        class="flex items-center justify-between bg-gray-100 bg-blue px-3 py-2">
                        <div class="flex items-center">
                            <logo-icon class="w-5 h5 text-blue"/>
                            <span class="text-blue-50 pl-2">Create your porch</span>
                        </div>
                        <a href="#" class="text-blue-50" @click.prevent="onCancelBtnClick">
                            <times-icon class="w-5 h-5 text-blue-50"/>
                        </a>
                    </header>

                    <div class="flex items-center justify-center mt-5">
                        <p class="text-lg">Lets get you started by creating a porch!</p>
                    </div>

                    <div class="flex items-center justify-center mt-10">
                        <div
                            @click="step=1"
                            class="border border-gray-100 px-5 flex flex-col rounded items-center py-8 cursor-pointer"
                            :class="step===1 ? 'bg-blue text-blue-50 font-semibold tracking-wide':''"
                        >
                            <title-icon class="w-8 h-8"/>
                            <p class="leading-none mt-4 text-xs">Create a title</p>
                        </div>
                        <div
                            @click="step=2"
                            class="border border-gray-100 px-5 flex flex-col rounded items-center ml-3 py-8 cursor-pointer"
                            :class="step===2 ? 'bg-blue text-blue-50 font-semibold tracking-wide':''"
                        >
                            <url-icon class="w-8 h-8"/>
                            <p class="leading-none mt-4 text-xs">Choose a url</p>
                        </div>
                    </div>

                    <form class="p-5 sm:px-8" @submit.prevent="onFormSubmit">
                        <div class="relative" v-if="step === 1">
                            <label for="title" class="block text-sm font-medium text-gray-700 sr-only">
                                Title
                            </label>
                            <div class="mt-1">
                                <input
                                    v-model="form.title"
                                    type="text" name="title" id="title"
                                    placeholder="Title of your porch ..."
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full
                                    sm:text-sm text-gray-600 rounded-md placeholder-gray-300"
                                    :class="bioErrors.title ? 'border-red-500':'border-gray-300'"
                                >
                            </div>
                            <p
                                v-if="bioErrors.title"
                                class="mt-0.5 ml-0.5 text-red-500"
                            >{{ bioErrors.title }}</p>
                        </div>
                        <div
                            v-if="step === 2"
                            class="w-full">
                            <label for="slug" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 sr-only">
                                Url
                            </label>
                            <div class="mt-1">
                                <div class="flex rounded-md shadow-sm">
                                      <span
                                          class="inline-flex text-gray-400 items-center px-3 rounded-l-md border border-r-0 sm:text-sm">
                                        linkspor.ch/{{ username }}/
                                      </span>
                                    <input
                                        v-model="form.slug"
                                        placeholder="e.g. my-awesome-product"
                                        type="text" name="slug" id="slug"
                                        class="flex-1 block w-full focus:ring-blue focus:border-blue min-w-0
                                            rounded-none rounded-r-md sm:text-sm text-gray-600 placeholder-gray-300"
                                        :class="bioErrors.slug ? 'border-red-500':'border-gray-200'"
                                    >
                                </div>
                                <p
                                    v-if="bioErrors.slug"
                                    class="mt-0.5 ml-0.5 text-red-500"
                                >{{ bioErrors.slug }}</p>
                            </div>
                        </div>
                        <div class="block h-1 border-b border-gray-200 mt-10"></div>
                        <template v-if="step === 1">
                            <div class="flex items-center justify-between mt-5">
                                <button
                                    type="button"
                                    class="inline-block text-center uppercase tracking-wider relative px-5 py-2 border border-green
                                           text-xs font-medium rounded text-green-50 bg-green disabled:opacity-50"
                                    disabled="true"
                                >previous
                                </button>
                                <button
                                    @click="step=2"
                                    class="inline-block text-center ml-5 uppercase tracking-wider relative px-5 py-2
                                border border-green text-xs font-medium rounded text-green hover:bg-green
                                hover:text-green-50 focus:outline-none focus:ring-green focus:border-green"
                                >Next
                                </button>
                            </div>
                        </template>
                        <template v-if="step === 2">
                            <div class="flex items-center justify-between mt-5">
                                <button
                                    type="button"
                                    @click="step=1"
                                    class="inline-block text-center uppercase tracking-wider relative px-5 py-2 border border-green
                                           text-xs text-green font-medium rounded focus:outline-none focus:ring-2 bg-white hover:bg-green
                                           hover:text-green-50 focus:ring-green focus:border-green"
                                >Previous
                                </button>
                                <button
                                    class="inline-block text-center ml-5 uppercase tracking-wider relative px-5 py-2
                                border border-green text-xs font-medium rounded text-green hover:bg-green
                                hover:text-green-50 focus:outline-none focus:ring-green focus:border-green"
                                >Create Porch
                                </button>
                            </div>
                        </template>

                    </form>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import SelectIcon from "../Icons/SelectIcon";
import LoadingBeat from "../LoadingBeat";
import InlineSvg from "../InlineSvg";
import LogoIcon from "../Icons/LogoIcon";
import TimesIcon from "../Icons/TimesIcon";
import TitleIcon from "../Icons/TitleIcon";
import UrlIcon from "../Icons/UrlIcon";

export default {
    name: "CreatePorchModal",
    components: {UrlIcon, TitleIcon, TimesIcon, LogoIcon, Notification, InlineSvg, LoadingBeat, SelectIcon},
    props: {
        showCreateBioModal: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            loading: false,
            step: 1,
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
        },
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

