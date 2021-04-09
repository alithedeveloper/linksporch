<template>
    <div v-if="showIcons"
         class="fixed z-40 inset-0 overflow-y-auto"
         aria-labelledby="modal-title" role="dialog"
         aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
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
                    class="inline-block relative align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-y-auto shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
                    <form @submit.prevent="onFormSubmit" class="mt-5">
                        <label for="search" class="block text-sm font-medium text-gray-700 sr-only">Select an
                            Icon</label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <p v-if="svgSearchError.length > 0"
                               class="text-red-600 text-sm">{{ svgSearchError }}</p>
                            <div class="flex">
                                <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                    <input type="text" name="search" id="search"
                                           v-model="form.searchTerm"
                                           @input="onSvgSearchInput"
                                           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md pl-3 sm:text-sm "
                                           :class="svgSearchError.length > 0 ? 'border-red-500' : 'border-gray-300'"
                                           placeholder="Choose an icon">
                                </div>
                                <button
                                    class="-ml-px uppercase tracking-wider relative inline-flex items-center space-x-2 px-8 py-3 border-2 border-indigo-600 text-sm
                                            font-medium rounded-r-md text-indigo-50 focus:outline-none focus:ring-1 bg-indigo-700 hover:bg-indigo-600 focus:ring-indigo-800 focus:border-indigo-800"
                                    :class="disabledBtn ? 'disabled:opacity-25 cursor-not-allowed':''"
                                    :disabled="disabledBtn"
                                >

                                    <select-icon classes="h-5 w-5 text-indigo-50"/>
                                    <span>Confirm</span>
                                </button>
                            </div>

                        </div>
                    </form>
                    <loading-beat v-if="loading" classes="text-blue-600"/>
                    <div class="mt-3 text-center sm:mt-5 min-h-[5rem] h-[30rem]">
                        <div class="grid grid-cols-6 gap-0.5 gap-x-0.5">

                            <div class="bg-gray-100 w-full py-0 px-3 cursor-pointer"
                                 v-for="svg in svgIcons" :key="svg.id">
                                <inline-svg :markup="svg.markup"
                                            tagClasses="flex items-center justify-center py-5"
                                            @is-clicked="onClickSvgIcon(svg)"/>
                            </div>

                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import {debounce, isEmpty} from 'lodash';
import SelectIcon from "./Icons/SelectIcon";
import LoadingBeat from "./LoadingBeat";
import InlineSvg from "./InlineSvg";

export default {
    name: "SvgModal",
    components: {Notification, InlineSvg, LoadingBeat, SelectIcon},
    props: {
        svgs: {
            type: Array,
            default: []
        },
        showIcons: {
            type: Boolean,
            default: false
        },
        link: {
            type: Object,
            default: {}
        }

    },
    data() {
        return {
            loading: false,
            svgIcon: null,
            svgSearchError: '',
            form: {
                searchTerm: '',
            }
        }
    },
    watch: {
        'form.searchTerm': debounce(function (newValue) {
            this.form.searchTerm = newValue
        }, 1000)
    },
    computed: {
        svgIcons() {
            return this.svgs.filter(svg => svg.name.toLowerCase().startsWith(this.form.searchTerm.toLowerCase()))
        },
        svgIconExists() {
            this.svgIcon = this.svgs.find(svg => svg.name.toLowerCase() === this.form.searchTerm.toLowerCase())
            return typeof this.svgIcon !== 'undefined'
        },
        disabledBtn() {
            return this.form.searchTerm.length === 0 ||
                this.svgSearchError.length > 0
        }
    },
    methods: {
        onClickSvgIcon(svg) {
            this.form.searchTerm = svg.name
        },
        onSvgSearchInput() {
            this.svgSearchError = ''
        },
        onClickOutside() {
            const notification = this.$root.$el.querySelector('.notification')
            if (this.showIcons === true && notification === null) {
                this.$emit('update:showIcons', !this.showIcons)
                this.$emitter.emit('modal-activation', {show: !this.showIcons})
            }
        },
        onFormSubmit() {
            if (isEmpty(this.form.searchTerm)) {
                this.svgSearchError = 'You forgot to choose an icon'
                return false;
            }

            if (!this.svgIconExists) {
                this.svgSearchError = 'Please choose an icon from the list'
                return false;
            }

            this.$inertia.post(route('link.icon.update', {link: this.link.id}), this.form, {
                onStart: () => {
                    this.loading = true
                },
                onSuccess: () => {
                    this.loading = false
                    this.$emit('update:showIcons', !this.showIcons)
                    this.$emit('update:svgIcon', this.svgIcon)
                    this.$emitter.emit('reload')
                }
            })
        },
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
