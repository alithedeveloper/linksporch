<template>
    <div>
        <div>
            <div class="py-2 bg-gray-200 flex shadow items-center justify-between">
                <p class="flex-1 block font-semibold text-center">{{ content.title }}</p>
                <span
                    class="inline-block mr-2 cursor-pointer text-gray-500"
                    @click="onSlideDownCancelClick"
                >
                <svg class="fill-current w-6 h-6" viewBox="0 0 512 512">
                  <path
                      d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 464c-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216 0 118.7-96.1 216-216 216zm94.8-285.3L281.5 256l69.3 69.3c4.7 4.7 4.7 12.3 0 17l-8.5 8.5c-4.7 4.7-12.3 4.7-17 0L256 281.5l-69.3 69.3c-4.7 4.7-12.3 4.7-17 0l-8.5-8.5c-4.7-4.7-4.7-12.3 0-17l69.3-69.3-69.3-69.3c-4.7-4.7-4.7-12.3 0-17l8.5-8.5c4.7-4.7 12.3-4.7 17 0l69.3 69.3 69.3-69.3c4.7-4.7 12.3-4.7 17 0l8.5 8.5c4.6 4.7 4.6 12.3 0 17z"/>
                </svg>
            </span>
            </div>
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="bg-white shadow rounded-b-lg">
                <div class="flex items-center px-4 py-5 sm:p-6">
                    <template v-if="svgIconExists">
                        <inline-svg remove-attributes="true"
                                    :markup="svgIcon.markup"
                                    classes="text-gray-500 w-[8rem] h-[8rem] mr-4"
                        />
                    </template>
                    <div v-if="content.name === 'schedule_link'" class="w-full flex items-center">
                        <date-time
                            :link="link"
                            wrapperClass="w-full flex items-center"
                            classes="border-gray-300 rounded py-2 w-full"
                        />
                    </div>
                    <div v-else>
                        <p class="max-w-xl mt-2 text-sm text-gray-500">
                            {{ content.description }}
                        </p>
                        <button-input
                            classes="bg-indigo-500 text-indigo-100 hover:bg-indigo-700 focus:ring-indigo-500 mt-2"
                            linkType="linkType"
                            @click="onButtonClick(content.name)"
                        >{{ content.buttonText }}
                        </button-input>
                    </div>

                </div>
            </div>
        </div>

        <svg-modal
            :svgs="svgs"
            v-model:show-icons="showIcons"
            :link="link"
            v-model:svg-icon="svgIcon"
        />
    </div>

</template>
<script>
import moment from 'moment'
import ButtonInput from "@/Components/Input/ButtonInput";
import CancelIcon from "../Icons/CancelIcon";
import SvgModal from "../SvgModal";
import InlineSvg from "../InlineSvg";
import DateTime from "../DateTime";


export default {
    name: "LinkSlideDown",
    components: {DateTime, SvgModal, CancelIcon, ButtonInput, InlineSvg},
    props: {
        content: {
            type: Object,
            default: {}
        },
        modelValue: Boolean,
        link: {
            type: Object,
            default: {}
        },
        svgs: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            showIcons: false,
            svgIcon: {},
            scheduledAt: moment().format(),
        }
    },
    computed: {
        svgIconExists() {
            return Object.keys(this.svgIcon).length > 0 &&
                this.content.name === 'icon_link'
        }
    },
    watch: {
        // we need to emit the event for z-index of sidebar
        // in Bio layout
        showIcons(newValue) {
            this.$emitter.emit('modal-activation', {show: newValue})
        }
    },
    methods: {
        onButtonClick(linkType) {
            // action the linkType here
            if (linkType === 'icon_link') {
                this.showIcons = !this.showIcons
            }
        },
        onSlideDownCancelClick() {
            this.$emit('update:modelValue', !this.modelValue)
        }
    }
}
</script>
