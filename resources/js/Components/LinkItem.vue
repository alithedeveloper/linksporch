<template>
    <div class="mb-10">
        <div class="bg-white shadow-md rounded-t-lg"
             :class="!slideDown ? 'rounded-b-lg':''"
             style="min-height: 120px">
            <div class="flex items-center" style="min-height: 120px">
                <!-- Link Handle -->
                <div
                    class="flex items-center flex-shrink-0 cursor-move w-7"
                    style="min-height: 120px"
                >
                    <handle-icon
                        class="block w-6 h-6 mx-auto text-gray-600 fill-current"
                    />
                </div>

                <!-- Link Details -->
                <div
                    class="flex-1 w-full px-2 mr-2 border-l-2 border-gray-200 md:mr-4"
                    style="min-height: 120px"
                >
                    <!-- Title -->
                    <div class="w-full mt-5">
                        <div class="flex items-center" v-if="isEditingTitle">
                            <link-title
                                v-model:title="form.title"
                                v-model:is-editing-title="isEditingTitle"
                                :error="error.title"
                                :data="link"
                                :persist="persistEdit"
                            />
                        </div>
                        <div class="flex items-center p-1" v-else>
                            <p class="font-medium">{{ link.title }}</p>
                            <span class="block pl-2 cursor-pointer" @click="handleEditTitle">
                                <edit-icon class="w-3 h-3 fill-current"/>
                            </span>
                        </div>
                    </div>
                    <!--/Title-->

                    <!--/ URL -->
                    <div class="w-full">
                        <!--/ editing -->
                        <div class="flex items-center" v-if="isEditingUrl">
                            <link-url
                                v-model:url="form.url"
                                v-model:is-editing-url="isEditingUrl"
                                :error="error.url"
                                :data="link"
                                :persist="persistEdit"
                            />
                        </div>
                        <!--/ else -->
                        <div class="flex items-center p-1" v-else>
                            <p class="text-sm font-light">{{ link.url }}</p>
                            <span
                                class="pl-2 block cursor-pointer pb-0.5"
                                @click="handleEditUrl"
                            >
                <edit-icon class="w-3 h-3 fill-current"/>
              </span>
                        </div>
                    </div>
                    <!--/ URL -->

                    <div class="flex items-center w-full cursor-pointer">
                        <div class="py-2 pr-2" @click="handleSlideDown('leap_link')">
                            <forward-icon class="w-6 h-6 text-gray-500 fill-current"/>
                        </div>
                        <div class="px-3 py-2" @click="handleSlideDown('icon_link')">
                            <upload-icon class="w-6 h-6 text-gray-500 fill-current"/>
                        </div>
                        <div class="px-3 py-2" @click="handleSlideDown('schedule_link')">
                            <schedule-icon class="w-6 h-6 text-gray-500 fill-current"/>
                        </div>

                        <div class="px-3 py-2">
                            <stats-icon class="w-5 h-5 mb-1 text-gray-500 fill-current"/>
                        </div>
                    </div>
                </div>

                <div
                    class="relative flex flex-col items-center justify-between flex-shrink-0 py-5"
                    style="min-height: 120px"
                >
                    <toggle-input
                        :status="form.is_active"
                        @update:status="handleToggle"
                        class="mr-4"
                    />
                    <div class="p-5 absolute right-0 cursor-pointer -bottom-0.5">
                        <trash-icon class="w-5 h-5 text-gray-800 fill-current"/>
                    </div>
                </div>
            </div>
        </div>

        <link-slide-down
            v-show="slideDown"
            :content="displayContent"
            v-model="slideDown"
        />

    </div>
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
import TextInput from "@/Components/Input/TextInput";
import CheckIcon from "@/Components/Icons/CheckIcon";
import CancelIcon from "@/Components/Icons/CancelIcon";
import LinkTitle from "@/Components/Link/LinkTitle";
import LinkUrl from "@/Components/Link/LinkUrl";
import LinkSlideDown from "@/Components/Link/LinkSlideDown";

export default {
    name: "LinkItem",
    props: {
        link: {
            type: Object,
            default: {},
        },
    },
    components: {
        TrashIcon,
        HandleIcon,
        UploadIcon,
        EditIcon,
        StatsIcon,
        ForwardIcon,
        ScheduleIcon,
        ToggleInput,
        TextInput,
        CheckIcon,
        CancelIcon,
        LinkTitle,
        LinkUrl,
        LinkSlideDown,
    },
    data() {
        return {
            isEditingTitle: false,
            isEditingUrl: false,
            error: {},
            slideDown: false,
            form: {
                is_active: this.link.is_active,
                title: this.link.title,
                url: this.link.url,
            },
            displayContent: {},
            content: [
                {
                    name: 'leap_link',
                    title: 'Leap Link',
                    description: `With Linktree PRO you can opt to temporarily forward all visitors directly
                                  to a destination, bypassing your Linktree altogether.`,
                    buttonText: 'Find out more'
                },
                {
                    name: 'icon_link',
                    title: 'choose an icon',
                    description: `Choose an icon to appear on the link. It usually helps in making your link
                                  button to stand out and easily recognizable`,
                    buttonText: 'Choose an icon'
                },
                {
                    name: 'schedule_link',
                    title: 'Schedule your link',
                    description: `With linkporch Pro account you can choose when your links go live`,
                    buttonText: 'Find Out More'
                }
            ]
        };
    },
    methods: {
        handleToggle(newValue) {
            this.form.is_active = !this.form.is_active;
            this.$inertia.put(
                this.route("link.status.update", this.link.id),
                this.form.is_active,
                {
                    preserveScroll: true,
                    onStart: () => (this.processing = true),
                    onSuccess: () => (this.processing = false),
                }
            );
        },
        handleEditUrl() {
            this.isEditingUrl = !this.isEditingUrl;
            if (this.isEditingTitle) this.isEditingTitle = false;
        },
        handleEditTitle() {
            this.isEditingTitle = !this.isEditingTitle;
            if (this.isEditingUrl) this.isEditingUrl = false;
        },
        handleCancelEdit(input) {
            if (input === "title") this.isEditingTitle = false;
            if (input === "url") this.isEditingUrl = false;
        },
        persistEdit(input) {
            this.$inertia.put(
                this.route("link.title.url.update", this.link.id),
                this.form,
                {
                    preserveScroll: true,
                    onStart: () => (this.processing = true),
                    onFinish: () => (this.processing = false),
                    onError: (error) => {
                        this.error = Object.assign({}, this.error, error);
                    },
                    onSuccess: () => {
                        this.error = {};
                        if (input === "title") {
                            this.isEditingTitle = false;
                        } else {
                            this.isEditingUrl = false;
                        }
                    },
                }
            );
        },
        handleSlideDown(link) {
            this.slideDown = true
            const leapUrlContent = this.content.find((contentItem) => contentItem.name === link)
            this.displayContent = Object.assign({}, this.displayContent, leapUrlContent)
        }
    },
};
</script>
