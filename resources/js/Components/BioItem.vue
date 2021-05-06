<template>
    <li class="relative rounded border border-gray-200 px-5 hover:bg-gray-50 sm:py-6 sm:pl-6 lg:pl-8 xl:pl-6">
        <div class="flex items-center justify-between">
            <!-- Repo name and link -->
            <div class="min-w-0">
                <Inertia-link :href="`/dashboard/bios/${bio.slug}`"
                              class="flex items-center space-x-3">
                  <span
                      :class="form.is_active ? 'bg-green-100' : 'bg-gray-100'"
                      class="flex items-center justify-center w-4 h-4  rounded-full" aria-hidden="true">
                    <span
                        :class="form.is_active ? 'bg-green-400' : 'bg-gray-400'"
                        class="w-2 h-2 rounded-full"></span>
                  </span>
                    <span class="block">
                    <h2 class="text-sm font-medium flex items-center">
                        <span class="text-gray-500">{{ bio.title }}</span>
                        <span class="pl-2 text-gray-400 hover:text-gray-500">
                            <right-arrow-circle-icon class="w-5 h-5" />
                        </span>
                    </h2>
                  </span>
                </Inertia-link>
                <a href="#" class="relative group flex items-center mt-3">
                    <span>
                        <forward-icon classes="flex-shrink-0 w-4 h-4 text-gray-400 group-hover:text-gray-500 fill-current"/>
                    </span>
                    <span
                        class="text-xs font-medium text-gray-500 truncate group-hover:text-gray-900">
                          {{ bio.url }}
                    </span>
                </a>

            </div>
            <div class="sm:hidden">
                <!-- Heroicon name: solid/chevron-right -->
                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
            <!-- Repo meta info -->
            <div class="flex-col items-end flex-shrink-0 hidden sm:flex">
                <div class="flex items-center space-x-3">
                    <span
                        @click="showEditForm=!showEditForm"
                        class="flex items-center justify-center text-gray-300 hover:text-gray-400 cursor-pointer">
                        <span class="mr-5 text-gray-600">Edit Porch</span>
                        <cog-icon class="w-6 h-6" />
                    </span>
                    <power-toggle :status="form.is_active" @update:status="handleToggle" />
                    <span
                        @click="onClickDeletePorch"
                        class="text-gray-300 hover:text-gray-400 cursor-pointer">
                        <trash-solid-icon class="w-6 h-6" />
                    </span>

                </div>
            </div>
        </div>
    </li>
    <edit-porch-modal v-model:show="showEditForm" :bio="bio"/>
    <confirmation-modal :show="deleteConfirmationModal">
        <template v-slot:title>
            Delete Porch
        </template>
        <template v-slot:content>
            Are you sure you want to delete this porch ?
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
</template>

<script>
import ToggleInput from "./Input/ToggleInput";
import ForwardIcon from "./Icons/ForwardIcon";
import PowerIconUp from "./Icons/PowerIconUp";
import PowerIconDown from "./Icons/PowerIconDown";
import PowerToggle from "./PowerToggle";
import TrashIcon from "./Icons/TrashIcon";
import TrashSolidIcon from "./Icons/TrashSolidIcon";
import CogIcon from "./Icons/CogIcon";
import RightArrowCircleIcon from "./Icons/RightArrowCircleIcon";
import EditPorchModal from "./Modals/EditPorchModal";
import ConfirmationModal from "../Jetstream/ConfirmationModal";
import JetButton from "@/Jetstream/Button";

export default {
    name: "BioItem",
    props: {
        bio: Object
    },
    components: {
        ConfirmationModal,
        EditPorchModal,
        RightArrowCircleIcon,
        CogIcon,
        TrashSolidIcon,
        TrashIcon,
        PowerToggle,
        PowerIconUp,
        PowerIconDown,
        ForwardIcon,
        ToggleInput,
        JetButton
    },
    data() {
        return {
            showEditForm: false,
            deleteConfirmationModal: false,
            form: this.$inertia.form({
                is_active: this.bio.is_active
            })
        }
    },
    methods: {
        handleToggle(newValue) {
            this.form.is_active = newValue
            this.form.put(this.route('bio.status.update', this.bio.slug), {
                preserveScroll: true,
                onStart: () => this.processing = true,
                onSuccess: () => this.processing = false
            })
        },
        onClickDeletePorch(){
            this.deleteConfirmationModal = true
        },
        onConfirmationCancelBtn(){
            this.deleteConfirmationModal= false
        },
        onConfirmationDeleteBtn(){
            this.$inertia.delete(route('bio.delete', { bio: this.bio.slug }),{
                onSuccess: () => {
                    this.$emitter.emit('notify',{
                        type: 'success',
                        title: 'Porch is being deleted successfully'
                    })
                }
            })
        }

    }

}
</script>

<style scoped>

</style>
