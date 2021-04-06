<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div v-if="uploadImageModal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
         aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pb-20 text-center sm:block sm:p-0">
            <transition
                enter-active-class="ease-out duration-300"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="ease-in duration-200"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
            <!--
              Background overlay, show/hide based on modal state.
            -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

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
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-2xl sm:w-full p-2 mx-5">
                <div>
                    <div class="text-center">
                        <cropper ref="cropper" class="example-cropper"
                                 :src="uploadedImage"
                                 :stencil-size="{
                                    width: 200,
                                    height: 200
                                }"
                                 default-boundaries="fill"
                                 :stencil-props="{
                                    movable: true,
                                    resizable: false,
                                    aspectRatio: 1,
                                }"
                                 :size-restrictions-algorithm="pixelsRestriction"
                        />
                    </div>
                </div>
                <div class="my-5 md:px-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                    <button
                        @click="onSaveImage"
                        type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">
                        Save
                    </button>
                    <button
                        @click="onClickCancelBtn"
                        type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
            </transition>
        </div>
    </div>

</template>

<script>
import {Cropper} from 'vue-advanced-cropper'
import 'vue-advanced-cropper/dist/style.css';
import LoadingBeat from "../LoadingBeat";

export default {
    name: "ImageModal",
    components: {
        LoadingBeat,
        Cropper
    },
    props: {
        uploadImageModal: {
            type: Boolean,
            default: false
        },
        uploadedImage: {
            type: String,
        },
        imageSrc:{
            type: [Boolean,String]
        },
        bio: {
            type: Object,
            required: true
        }
    },
    methods: {
        onClickCancelBtn() {
            this.$emit('update:upload-image-modal', !this.uploadImageModal)
        },
        pixelsRestriction({
          minWidth,
          minHeight,
          maxWidth,
          maxHeight,
          imageWidth,
          imageHeight
          }) {
            return {
                minWidth: minWidth,
                minHeight: minHeight,
                maxWidth: maxWidth,
                maxHeight: maxHeight
            };
        },
        onSaveImage() {
            const {canvas} = this.$refs.cropper.getResult();

            if (canvas) {
                const form = new FormData();
                canvas.toBlob(blob => {
                    form.append('avatar', blob)
                    axios.post(`/api/bio/${this.bio.id}/avatar`, form)
                        .then((response) => {
                            this.$emit('update:uploaded-image', response.data.path)
                            this.$emit('update:upload-image-modal', !this.uploadImageModal)
                            this.$emit('update:image-src', response.data.path)
                            this.$emitter.emit('reload')
                        })
                        .catch(error => {})
                })
            }


        }
    }
}
</script>

