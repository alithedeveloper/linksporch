<template>
    <li class="bg-white rounded-lg shadow-md" style="min-height: 120px">
        <div class="flex items-center" style="min-height: 120px;">

            <!-- Link Handle -->
            <div class="flex-shrink-0 cursor-move w-7 flex items-center" style="min-height: 120px;">
                <handle-icon class="w-6 h-6 block fill-current text-gray-600 block mx-auto"/>
            </div>

            <!-- Link Details -->
            <div class="px-2 flex-1 border-l-2 border-gray-200 w-full mr-2 md:mr-4" style="min-height: 120px;">

                <!-- Title -->
                <div class="mt-5 w-full">
                    <div class="flex items-center" v-if="isEditingTitle">
                        <div class="relative flex-1 mr-2">
                            <div class="flex items-center mb-2">
                                <label :for="`title-${link.id}`" class="sr-only">Title</label>
                                <input type="text"
                                       v-model="form.title"
                                       name="title"
                                       @keydown.enter="persistEdit('title')"
                                       :id="`title-${link.id}`"
                                       class="flex-1 space-x-2 block text-sm border-1 border-gray-300 rounded py-1 px-2 leading-none
                                             appearance-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-200" placeholder="Title">
                                <span
                                    @click="persistEdit('title')"
                                    class="block ml-2 cursor-pointer"><check-icon classes="w-6 h-6 text-gray-500"></check-icon> </span>
                                <span
                                    @click="handleCancelEdit('title')"
                                    class="block ml-2 cursor-pointer"><cancel-icon classes="w-6 h-6 text-gray-500"></cancel-icon> </span>
                            </div>

                            <p class="absolute right-0 text-xs leading-none text-red-600 -bottom-4"
                               id="title-id-1" v-if="errors.title">
                                {{ errors.title }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center p-1" v-else>
                        <p class="font-medium">{{ link.title }}</p>
                        <span class="pl-2 block cursor-pointer" @click="handleEditTitle">
                          <edit-icon class="fill-current w-3 h-3"/>
                        </span>
                    </div>


                </div>
                <!--/Title-->

                <!--/ URL -->
                <div class="w-full">
                    <!--/ editing -->
                    <div class="flex items-center" v-if="isEditingUrl">
                        <div class="relative flex-1 mr-2">
                            <div class="flex items-center">
                                <label :for="`url-${link.id}`" class="sr-only">Url</label>
                                <input type="text"
                                       name="url"
                                       v-model="form.url"
                                       :id="`url-${link.id}`"
                                       @keydown.enter="persistEdit('url')"
                                       class="w-full block text-sm border-1 border-gray-300 rounded py-1 px-2 leading-none
                                           appearance-none focus:ring-1 focus:ring-offset-1 focus:ring-indigo-200 my-2"
                                       placeholder="Url">
                                <span
                                    @click="persistEdit('url')"
                                    class="block ml-2 cursor-pointer tab-index"><check-icon classes="w-6 h-6 text-gray-500"></check-icon> </span>
                                <span
                                    @click="handleCancelEdit('url')"
                                    class="block ml-2 cursor-pointer"><cancel-icon classes="w-6 h-6 text-gray-500"></cancel-icon> </span>
                            </div>


                            <p class="absolute right-0 text-xs leading-none text-red-600 -bottom-4"
                               id="url-id" v-if="errors.url">
                               {{ errors.url }}
                            </p>
                        </div>


                    </div>
                    <!--/ else -->
                    <div class="flex items-center p-1" v-else>
                        <p class="font-light text-sm">{{ link.url }}</p>
                        <span class="pl-2 block cursor-pointer pb-0.5" @click="handleEditUrl">
                           <edit-icon class="fill-current w-3 h-3"/>
                        </span>
                    </div>

                </div>
                <!--/ URL -->

                <div class="w-full cursor-pointer flex items-center">
                    <div class="pr-2 py-2">
                        <forward-icon class="w-6 h-6 fill-current text-gray-500"/>
                    </div>
                    <div class="px-3 py-2">
                        <upload-icon class="w-6 h-6 fill-current text-gray-500"/>
                    </div>
                    <div class="px-3 py-2">
                        <schedule-icon class="w-6 h-6 fill-current text-gray-500"/>
                    </div>

                    <div class="px-3 py-2">
                        <stats-icon class="w-5 h-5 fill-current text-gray-500 mb-1"/>
                    </div>
                </div>

            </div>


            <div class="flex-shrink-0 flex flex-col justify-between items-center py-5 relative"
                 style="min-height: 120px;">
                <toggle-input :status="form.is_active" @update:status="handleToggle" class="mr-4"/>
                <div class="p-5 absolute bottom-0 right-0 cursor-pointer -bottom-0.5">
                    <trash-icon class="fill-current text-gray-800 w-5 h-5"/>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
import HandleIcon from "@/Components/Icons/HandleIcon";
import EditIcon from "@/Components/Icons/EditIcon";
import ScheduleIcon from "@/Components/Icons/ScheduleIcon";
import UploadIcon from "@/Components/Icons/UploadIcon";
import StatsIcon from "@/Components/Icons/StatsIcon";
import ForwardIcon from "@/Components/Icons/ForwardIcon";
import TrashIcon from "@/Components/Icons/TrashIcon";
import ToggleInput from "@/Components/Input/ToggleInput";
import CheckIcon from "./Icons/CheckIcon";
import CancelIcon from "./Icons/CancelIcon";


export default {
    name: "LinkItem",
    props: {
        link: {
            type: Object,
            default: {}
        },
        errors: {
            type: Object,
            default: {}
        }
    },
    components: {
        CancelIcon,
        CheckIcon,
        TrashIcon,
        HandleIcon,
        UploadIcon,
        EditIcon,
        StatsIcon,
        ForwardIcon,
        ScheduleIcon,
        ToggleInput
    },
    data() {
        return {
            isEditingTitle: false,
            isEditingUrl: false,
            form: {
                is_active: this.link.is_active,
                title: this.link.title,
                url: this.link.url,
            }
        }
    },
    methods: {
        handleToggle(newValue) {
            this.form.is_active = !this.form.is_active
            this.$inertia.put(this.route('link.status.update', this.link.id), this.form.is_active, {
                preserveScroll: true,
                onStart: () => this.processing = true,
                onSuccess: () => this.processing = false
            })
        },
        handleEditUrl() {
            this.isEditingUrl = !this.isEditingUrl
            if (this.isEditingTitle) this.isEditingTitle = false
        },
        handleEditTitle() {
            this.isEditingTitle = !this.isEditingTitle
            if (this.isEditingUrl) this.isEditingUrl = false
        },
        handleCancelEdit(input) {
            if(input === 'title') this.isEditingTitle = false
            if(input === 'url') this.isEditingUrl = false
        },
        persistEdit(input){
            this.$inertia.put(this.route('link.title.url.update', this.link.id), this.form, {
                preserveScroll: true,
                onStart: () => this.processing = true,
                onFinish: () => this.processing = false,
                onError:(erros)=> {
                  console.log(erros)
                },
                onSuccess: () => {
                    if (input === 'title'){
                        this.isEditingTitle = false
                    }else{
                        this.isEditingUrl = false
                    }
                }
            })

        }


    }
}
</script>
