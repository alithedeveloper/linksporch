<template>
    <app-layout>
        <bio-layout>
            <div class="lg:px-32">
                <!-- Bio -->
                <div class="mt-12">
                    <h2 class="font-semibold text-lg">Your Bio Profile</h2>
                    <div class="mt-4 bg-white p-6 rounded-lg shadow">
                        <div class="flex flex-col lg:flex-row items-start">
                            <div class="flex-grow lg:mt-0 lg:flex-grow-0 lg:flex-shrink-0">
                                <p class="text-sm font-medium text-gray-700 text-center mb-2 sr-only" aria-hidden="true">
                                    Photo
                                </p>
                                <div class="mt-1 lg:hidden">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 inline-block rounded-full overflow-hidden h-12 w-12" aria-hidden="true">
                                            <img class="rounded-full h-full w-full" src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=320&amp;h=320&amp;q=80" alt="">
                                        </div>
                                        <div class="ml-5 rounded-md shadow-sm">
                                            <div class="group relative border border-gray-300 rounded-md py-2 px-3 flex items-center justify-center hover:bg-gray-50 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-light-blue-500">
                                                <label for="user_photo" class="relative text-sm leading-4 font-medium text-gray-700 pointer-events-none">
                                                    <span>Change</span>
                                                    <span class="sr-only"> user photo</span>
                                                </label>
                                                <input id="user_photo" name="user_photo" type="file" class="absolute w-full h-full opacity-0 cursor-pointer border-gray-300 rounded-md">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="hidden relative rounded-full overflow-hidden lg:block">
                                    <img class="relative rounded-full w-40 h-40" src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=320&amp;h=320&amp;q=80" alt="">
                                    <label for="user-photo" class="absolute inset-0 w-full h-full bg-black bg-opacity-75 flex items-center justify-center text-sm font-medium text-white opacity-0 hover:opacity-100 focus-within:opacity-100">
                                        <span>Change</span>
                                        <span class="sr-only"> user photo</span>
                                        <input type="file" id="user-photo" name="user-photo" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer border-gray-300 rounded-md">
                                    </label>
                                </div>
                            </div>
                            <div class="flex-grow space-y-6 lg:ml-6">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 sr-only">
                                        Profile Title
                                    </label>
                                    <div class="mt-1 rounded-md shadow-sm flex">
                                        <input type="text" name="title" id="title"
                                               autocomplete="username"
                                               class="focus:ring-light-blue-500 focus:border-light-blue-500 flex-grow block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300"
                                               v-model="form.title">
                                    </div>
                                </div>

                                <div>
                                    <label for="about" class="block text-sm font-medium text-gray-700 sr-only">
                                        About
                                    </label>
                                    <div class="mt-1">
                                    <textarea id="about" name="about" rows="5"
                                              v-model="form.bio"
                                              class="shadow-sm focus:ring-light-blue-500 focus:border-light-blue-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-500 sr-only">
                                        Brief description for your profile. URLs are hyperlinked.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <!--/Bio-->

                <div class="mt-12">
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

export default {
    name: "Appearance",
    components: {ButtonInput, BioLayout, AppLayout},
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
          form: {
              title: this.bio.title,
              bio: this.bio.description,
              imageUrl : ''
          }
      }
    },
    computed: {
        presetsPath(){
            return this.$page.props.presets_path
        }
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
        }
    },
    created() {
        this.$emitter.on('iframeWindow',(iframeWindow) => {
            this.iFrameWindow = iframeWindow
        })
    },
}
</script>

<style scoped>

</style>
