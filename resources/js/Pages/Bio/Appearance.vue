<template>
    <app-layout>
        <bio-layout>
            <div class="lg:px-32">
                <!-- Bio -->
                <div class="mt-12 px-8 lg:px-0 max-w-2xl mx-auto">
                    <h2 class="font-semibold text-lg">Your Bio Profile</h2>
                    <div class="mt-4 bg-white p-6 rounded-lg shadow">
                        <div class="flex-grow">
                            <p class="text-sm font-medium text-gray-700 text-center mb-2 sr-only" aria-hidden="true">
                                Photo
                            </p>
                            <div class="mt-1">
                                <div class="flex items-center flex-row">
                                    <div class="flex-shrink-0 inline-block rounded-full overflow-hidden w-[8rem] w-[8rem]" aria-hidden="true">
                                        <img
                                            v-if="imageSrc && imageSrc.length"
                                            class="rounded-full h-full w-full" :src="imageSrc" alt="">
                                        <div
                                            v-if="!imageSrc"
                                            class="w-full flex justify-center">
                                            <profile-icon class="w-[7rem] h-[7rem] text-gray-300" />
                                        </div>

                                    </div>
                                    <div class="flex flex-col md:flex-row ml-5 w-full">
                                        <div class="md:ml-5 rounded-md shadow-sm w-full md:w-1/2 bg-green hover:bg-green-dark focus-within:ring-2
                                                    focus-within:ring-offset-2 focus-within:ring-green">
                                            <div class="group relative rounded py-3 px-3 h-full flex items-center justify-center">
                                                <label for="user_photo" class="relative flex items-center justify-center text-sm leading-4 font-medium text-white pointer-events-none">
                                                    <upload-simple-icon class="w-5 h-5"/>
                                                    <span class="inline-block ml-2">Pick an image</span>
                                                    <span class="sr-only"> user photo</span>
                                                </label>
                                                <input id="user_photo" name="bio_image" type="file"
                                                       ref="bioImage"
                                                       class="absolute w-full h-full opacity-0 cursor-pointer rounded"
                                                       @change="onUploadImage"
                                                       @click="resetImageUploader"
                                                       accept="image/*"
                                                >
                                            </div>
                                        </div>
                                        <form @submit.prevent="onDeleteBioImage" class="w-full mt-2 md:ml-2 md:w-1/2 md:mt-0">
                                            <button
                                                type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                               <simple-trash-icon class="w-5 h-5" />
                                                <span class="inline-block ml-2">Remove Image</span>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <form class="space-y-6 mt-10" @submit.prevent="onSubmitForm">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 sr-only">
                                    Profile Title
                                </label>
                                <div class="mt-1 rounded-md shadow-sm flex">
                                    <input type="text" name="title" id="title"
                                           autocomplete="username"
                                           class="focus:ring-light-blue-500 focus:border-light-blue-500 flex-grow block w-full min-w-0 rounded sm:text-sm"
                                           :class="bioUpdateErrors.title ? 'border-red-500':'border-gray-300'"
                                           v-model="form.title">
                                </div>
                                <p
                                    v-if="bioUpdateErrors.title"
                                    class="mt-0.5 ml-0.5 text-red-500">{{ bioUpdateErrors.title }}</p>
                            </div>

                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700 sr-only">
                                    Profile Slug
                                </label>
                                <div class="mt-1 rounded-md shadow-sm flex">
                                    <input type="text" name="slug" id="slug"
                                           autocomplete="username"
                                           class="focus:ring-light-blue-500 focus:border-light-blue-500 flex-grow block w-full min-w-0 rounded sm:text-sm"
                                           :class="bioUpdateErrors.slug ? 'border-red-500':'border-gray-300'"
                                           v-model="form.slug">
                                </div>
                                <p
                                    v-if="bioUpdateErrors.slug"
                                    class="mt-0.5 ml-0.5 text-red-500">{{ bioUpdateErrors.slug }}</p>
                            </div>

                            <div>
                                <label for="about" class="block text-sm font-medium text-gray-700 sr-only">
                                    About
                                </label>
                                <div class="mt-1">
                                    <textarea id="about" name="about" rows="5"
                                              v-model="form.bio"
                                              placeholder="your bio description ...."
                                              class="shadow-sm focus:ring-light-blue-500 focus:border-light-blue-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500 sr-only">
                                    Brief description for your profile. URLs are hyperlinked.
                                </p>
                            </div>

                            <div class="flex justify-end">

                                <button
                                    @click="onClickDeleteBio"
                                    class="text-center uppercase tracking-wider relative px-10 py-2.5 border-2 border-red-500 text-sm
                                font-medium rounded text-red-500 focus:outline-none hover:bg-red-500 hover:text-red-50 mr-5"
                                >Delete</button>

                                <button
                                    class="text-center uppercase tracking-wider relative px-10 py-2.5 border-2 border-green text-sm
                                font-medium rounded text-green-50 focus:outline-none focus:ring-2 bg-green focus:ring-green-dark
                                focus:border-green-dark"
                                >Update</button>

                            </div>
                        </form>
                    </div>
                </div>
                <confirmation-modal :show="deleteConfirmationModel">
                    <template v-slot:title>
                        Delete Bio
                    </template>
                    <template v-slot:content>
                        Are you sure you want to delete this profile ?
                    </template>
                    <template v-slot:footer>
                        <jet-button
                            @click="onConfirmationCancelBtn"
                            class="bg-blue py-2.5 px-5 mr-5"
                        >Never mind</jet-button>
                        <jet-button
                            @click="onConfirmationDeleteBtn"
                            class="bg-red-500 py-2.5 px-5"
                        >Delete</jet-button>
                    </template>
                </confirmation-modal>
                <upload-image-modal
                    v-model:upload-image-modal="uploadImageModal"
                    v-model:uploaded-image="uploadedImage"
                    v-model:image-src="imageSrc"
                    :bio="bio"
                />
               <!--/Bio-->

                <div class="mt-12 sm:max-w-2xl mx-auto">
                    <h2 class="font-semibold text-lg">Choose a preset</h2>
                    <div class="mt-4 bg-white p-6 rounded-lg shadow">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-4" @click="onClickPreset('pink')">
                                <img :src="`${presetsPath}/Pink.png`" alt="">
                            </div>
                            <div class="col-span-4" @click="onClickPreset('blue')">
                                <img :src="`${presetsPath}/Indigo.png`" alt="">
                            </div>
                            <div class="col-span-4" @click="onClickPreset('green')">
                                <img :src="`${presetsPath}/green.png`" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </bio-layout>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BioLayout from "@/Layouts/BioLayout"
import ButtonInput from "@/Components/Input/ButtonInput";
import PresetStyler from "@/Utils/PresetStyler";
import UploadSimpleIcon from "@/Components/Icons/UploadSimpleIcon";
import SimpleTrashIcon from "@/Components/Icons/SimpleTrashIcon";
import UploadImageModal from "@/Components/Modals/UploadImageModal";
import ProfileIcon from "@/Components/Icons/ProfileIcon";
import ConfirmationModal from "../../Jetstream/ConfirmationModal";
import JetButton from "../../Jetstream/Button";

export default {
    name: "Appearance",
    components: {
        JetButton,
        ConfirmationModal,
        ProfileIcon,
        SimpleTrashIcon,
        UploadSimpleIcon,
        ButtonInput,
        BioLayout,
        AppLayout,
        UploadImageModal
    },
    props:{
        bio:{
            type: Object,
            required: true,
            default: {}
        }
    },
    data(){
      return {
          iFrameWindow : null,
          uploadImageModal: false,
          uploadedImage:'',
          imageSrc:'',
          loading: false,
          bioUpdateErrors: {},
          deleteConfirmationModel: false,
          form: this.$inertia.form({
              title: this.bio.title,
              slug: this.bio.slug,
              bio: this.bio.description,
          })
      }
    },
    watch:{
        uploadImageModal(newValue){
            this.$emitter.emit('modal-activation', { show: newValue})
        },
        'form.title'(newValue){
            if (newValue.length) this.form.slug = newValue.slugify('-')
            if (Object.keys(this.bioUpdateErrors).length) this.bioUpdateErrors = {}
        }
    },
    computed: {
        presetsPath(){
            return this.$page.props.presets_path
        },

    },
    methods: {
        onClick(bgColor) {
            // let bg = null;
            //
            // switch (bgColor) {
            //     case 'blue':
            //         bg = 'layout-3';
            //         break;
            //     case 'green':
            //         bg = 'layout-1';
            //         break;
            //     case 'red':
            //         bg = 'layout-2';
            //         break;
            // }
            //
            // let data = {
            //     style: bg,
            //     text: 'This will be long text'
            // };
            //
            // data = JSON.stringify(data)
            // this.iFrameWindow.postMessage(data, '*')
        },
        onClickPreset(preset){
            let presetStyler = new PresetStyler(preset)
            // const data = JSON.stringify(presetStyler.styles)
            const data = presetStyler.styles
            this.iFrameWindow.postMessage(data, '*')
        },
        resetImageUploader(){
            this.$refs.bioImage.value = '';
        },
        onUploadImage(event){
            // Reference to the DOM input element
            let input = event.target;
            // Ensure that you have a file before attempting to read it
            if (input.files && input.files[0]) {
                // create a new FileReader to read this image and convert to base64 format
                const reader = new FileReader();
                // Define a callback function to run, when FileReader finishes its job
                reader.onload = (e) => {
                    // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                    // Read image as base64 and set to imageData
                    this.uploadedImage = e.target.result;
                };
                // Start the reader job - read file as a data url (base64 format)
                reader.readAsDataURL(input.files[0]);
                this.uploadImageModal = !this.uploadImageModal
            }
        },
        onDeleteBioImage(){
            if (!this.bio.image) return;
            this.loading = true
            this.$inertia.delete(route('bio.avatar.delete',{
                bio : this.bio.slug,
                avatar: this.bio.image.imageable_id
            }), {
                preserveScroll : true,
                onSuccess: () => {
                    this.loading = false
                    this.$emitter.emit('reload')
                    this.imageSrc = false
                }
            })
        },
        onSubmitForm(){
            this.form.put(route('bio.update', this.bio.slug),{
                preserveScroll : true,
                onSuccess: () => {
                    this.loading = false
                },
                onError: (errors) => {
                    this.bioUpdateErrors = errors
                }
            })
        },
        onClickDeleteBio(){
            this.deleteConfirmationModel = !this.deleteConfirmationModel
        },
        onConfirmationCancelBtn(){
            this.deleteConfirmationModel = !this.deleteConfirmationModel
        },
        onConfirmationDeleteBtn(){
            this.$inertia.delete(route('bio.delete', { bio: this.bio.slug}),{
                onSuccess: () => {
                    this.$emitter.emit('notify',{
                        type: 'success',
                        title: 'Profile is being deleted successfully'
                    })
                }
            })
        }

    },
    mounted() {
        if(this.bio.image && this.bio.image.path.length){
            this.imageSrc = `/${this.bio.image.path}`
            return;
        }
        this.imageSrc = false;
    },
    created() {
        this.$emitter.on('iframeWindow',(iframeWindow) => {
            this.iFrameWindow = iframeWindow
        })
    },
}
</script>

