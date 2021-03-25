<template>
    <li class="relative py-5 pl-4 pr-6 hover:bg-gray-50 sm:py-6 sm:pl-6 lg:pl-8 xl:pl-6">
        <div class="flex items-center justify-between space-x-4">
            <!-- Repo name and link -->
            <div class="min-w-0 space-y-3">
                <div class="flex items-center space-x-3">
                  <span
                      :class="form.is_active ? 'bg-green-100' : 'bg-gray-100'"
                      class="flex items-center justify-center w-4 h-4  rounded-full" aria-hidden="true">
                    <span
                        :class="form.is_active ? 'bg-green-400' : 'bg-gray-400'"
                        class="w-2 h-2 rounded-full"></span>
                  </span>
                    <span class="block">
                    <h2 class="text-sm font-medium">
                      <a href="#">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        {{ bio.title }}
                      </a>
                    </h2>
                  </span>
                </div>
                <a href="#" class="relative group flex items-center space-x-2.5">
                    <span>
                        <forward-icon classes="flex-shrink-0 w-4 h-4 text-gray-400 group-hover:text-gray-500 fill-current"/>
                    </span>
                    <span
                        class="text-sm font-medium text-gray-500 truncate group-hover:text-gray-900">
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
            <div class="flex-col items-end flex-shrink-0 hidden space-y-3 sm:flex">
                <p class="flex items-center space-x-4">
                    <inertia-link :href="`/dashboard/bios/${bio.slug}`"
                       class="relative text-sm font-medium text-gray-500 hover:text-gray-900">
                        Visit site
                    </inertia-link>
                    <button
                        class="relative bg-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        type="button">
                        <span class="sr-only">Add to favorites</span>
                        <!-- Heroicon name: solid/star -->
                        <svg class="w-5 h-5 text-yellow-300 hover:text-yellow-400"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" aria-hidden="true">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </button>

                    <toggle-input :status="form.is_active" @update:status="handleToggle"/>
                </p>
                <p class="flex space-x-2 text-sm text-gray-500">
                    <span>Laravel</span>
                    <span aria-hidden="true">&middot;</span>
                    <span>Last deploy 3h ago</span>
                    <span aria-hidden="true">&middot;</span>
                    <span>United states</span>
                </p>
            </div>
        </div>
    </li>
</template>

<script>
import ToggleInput from "./Input/ToggleInput";
import ForwardIcon from "./Icons/ForwardIcon";

export default {
    name: "BioItem",
    props: {
        bio: Object
    },
    components: {
        ForwardIcon,
        ToggleInput
    },
    data() {
        return {
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
        }
    }

}
</script>

<style scoped>

</style>
