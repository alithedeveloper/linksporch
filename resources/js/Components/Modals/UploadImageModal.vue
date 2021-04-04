<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div v-if="uploadImageModal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

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
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div>
                    <div class="mt-3 text-center sm:mt-5">
                        <loading-beat v-if="imageLoading" />
                        <cropper ref="cropper" class="example-cropper"
                                 :src="uploadedImage"
                                 :stencil-size="{
                                    width: 200,
                                    height: 200
                                }"
                                 :stencil-props="{
                                    handlers: {},
                                    movable: true,
                                    resizable: false,
                                    aspectRatio: 1,
                                }"

                                 @ready="ready"
                                 @error="error"
                        />
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                    <button
                        @click="onSaveImage"
                        type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">
                        Save
                    </button>
                    <button
                        @click="onClickCancelBtn"
                        type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { Cropper } from 'vue-advanced-cropper'
import 'vue-advanced-cropper/dist/style.css';
import LoadingBeat from "../LoadingBeat";

export default {
    name: "ImageModal",
    components:{
        LoadingBeat,
        Cropper
    },
    props:{
        uploadImageModal:{
            type: Boolean,
            default: false
        },
        uploadedImage: {
            type: String,
        },
        bio: {
            type: Object,
            required: true
        }
    },
    data(){
        return{
            imageLoading : false
        }
    },
    watch: {
        imageLoading(value) {
            if (value) {
                this.img.loading = true;
            }
        }
    },
    methods:{
        onClickCancelBtn(){
            this.$emit('update:upload-image-modal', !this.uploadImageModal)
        },
        onSaveImage(){
            const { canvas } = this.$refs.cropper.getResult();

            if (canvas){
                const form = new FormData();
                canvas.toBlob(blob => {
                    form.append('avatar', blob)
                    axios.post(`/api/bio/${this.bio.id}/avatar`, form)
                    .then((response) => {
                        this.$emit('update:uploaded-image', canvas.toDataURL('image/jpeg'))
                        this.$emit('update:upload-image-modal', !this.uploadImageModal)
                    })
                    .catch(error => {

                    })
                })
            }

            // data.append('image', this.originalImage)
            // data.append('coordinates', result.coordinates)


        },
        ready(){
            this.imageLoading = false;
        },
        error(){
            this.imageLoading = false;
            console.log('there has been error')
        }
    },
    created() {
        // console.log(this.showImageModal)
    }
}
</script>

