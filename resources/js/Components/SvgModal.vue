<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div v-if="showIcons" class="fixed z-40 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!--
              Background overlay, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                 aria-hidden="true"></div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div
                class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-y-auto shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
                <div>
                    <div>
                        <label for="search" class="sr-only">Search for an icon</label>
                        <input type="text"
                               name="search"
                               id="search"
                               v-model="searchTerm"
                               class="shadow-sm py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                               placeholder="Search for an icon">
                    </div>
                    <div class="mt-3 text-center sm:mt-5 min-h-[5rem] h-[30rem]">
                        <div class="grid grid-cols-6 gap-0.5 gap-x-0.5">
                            <div class="bg-indigo-100 w-full py-0 px-3 cursor-pointer"
                                 v-for="svg in svgIcons" :key="svg.id">
                              <span
                                  v-html="svg.markup"
                                  @click="onClickSvgIcon(svg)"
                                  class="w-6 h-6 p-2 fill-current text-in"
                              ></span>
                                <span class="text-[10px] text-center">{{ svg.name }}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {debounce} from 'lodash';
export default {
    name: "SvgModal",
    props: {
        svgs: {
            type: Array,
            default: []
        },
        showIcons:{
            type: Boolean,
            default: false
        }

    },
    data(){
        return {
            searchTerm: '',
        }
    },
    watch:{
        searchTerm: debounce(function (newValue) {
            this.searchTerm = newValue
        },500)
    },
    computed: {
        svgIcons() {
            return this.svgs.filter(svg => svg.name.toLowerCase().startsWith(this.searchTerm.toLowerCase()))
        }
    },
    methods: {
        onClickSvgIcon(svg){
            this.searchTerm = svg.name
            // this.$inertia.post(this.route('link.icon.update', {id : svg.id })
        }
    },
}
</script>

<style>

</style>
