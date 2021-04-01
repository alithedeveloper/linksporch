<template>
    <div v-if="showIcons" class="fixed z-40 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
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
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" tabindex="0"
                     aria-hidden="true" @keydown.esc="$emit('update:showIcons', !showIcons)"></div>
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
                    class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-y-auto shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
                    <form @submit.prevent="onFormSubmit">
                        <label for="search" class="block text-sm font-medium text-gray-700 sr-only">Select an
                            Icon</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                <input type="text" name="search" id="search"
                                       v-model="form.searchTerm"
                                       class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md pl-3 sm:text-sm border-gray-300"
                                       placeholder="Choose an icon">
                            </div>
                            <button
                                class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                <select-icon classes="h-5 w-5 text-gray-400"/>
                                <span>Pick</span>
                            </button>
                        </div>
                    </form>
                    <loading-beat v-if="loading" classes="text-blue-600"/>
                    <div class="mt-3 text-center sm:mt-5 min-h-[5rem] h-[30rem]">
                        <div class="grid grid-cols-6 gap-0.5 gap-x-0.5">

                            <div class="bg-indigo-100 w-full py-0 px-3 cursor-pointer"
                                 v-for="svg in svgIcons" :key="svg.id">
                              <span
                                  v-html="svg.markup"
                                  @click="onClickSvgIcon(svg)"
                                  class="flex items-center justify-center py-5"
                              ></span>
                            </div>

                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import {debounce} from 'lodash';
import SelectIcon from "./Icons/SelectIcon";
import LoadingBeat from "./LoadingBeat";

export default {
    name: "SvgModal",
    components: {LoadingBeat, SelectIcon},
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
            form: {
                searchTerm: '',
            }
        }
    },
    watch: {
        'form.searchTerm': debounce(function (newValue) {
            this.form.searchTerm = newValue
        }, 500)
    },
    computed: {
        svgIcons() {
            return this.svgs.filter(svg => svg.name.toLowerCase().startsWith(this.form.searchTerm.toLowerCase()))
        }
    },
    methods: {
        onClickSvgIcon(svg) {
            this.form.searchTerm = svg.name
        },
        onFormSubmit() {
            this.loading = true
            let svgIcon = this.svgIcons.find(svg => svg.name.toLowerCase() === this.form.searchTerm.toLowerCase())
            axios.post(`/api/link/${this.link.id}/icon`, this.form)
                .then((response) => {
                    this.loading = false
                    this.$emit('update:showIcons', !this.showIcons)
                    this.$emit('update:svgIcon', svgIcon)
                    this.$emitter.emit('reload')
                })
                .catch((error) => this.loading = false)
        }
    },
}
</script>

<style>
.icon-tabler {
    color: red;
    width: 32px;
    height: 32px;
    stroke-width: 1.25;
}
</style>
