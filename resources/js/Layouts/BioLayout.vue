<template>
    <div class="flex flex-col min-w-0 flex-1 overflow-hidden">
        <div class="flex-1 relative z-0 flex overflow-hidden">
            <section class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
                <div class="bg-white px-6 flex items-center">
                    <a href="#"
                       class="border-b-2 mr-8 border-gray-100 inline-block px-2 py-4  hover:border-indigo-700 transition duration-150 ease-in-out">Links</a>
                    <a href="#" class="border-b-2 mr-8 border-black inline-block px-2 py-4">Appearance</a>
                    <a href="#" class="border-b-2 mr-8 border-black inline-block px-2 py-4">Settings</a>
                    <a href="#" class="border-b-2 mr-8 border-black inline-block px-2 py-4">Go Pro</a>
                </div>
                <slot></slot>
            </section>
            <aside class="hidden relative xl:flex xl:flex-col flex-shrink-0 w-5/12 border-l border-gray-200">
                <!-- Start secondary column (hidden on smaller screens) -->
                <div class="bg-white px-6 flex items-center justify-between border-b-2 border-white">
                    <a href="#" class="py-4 block underline">https://www.links-porch.com/@ali.shah/project</a>
                    <share-button/>
                </div>
            </aside>
        </div>
    </div>
</template>

<script>

import ShareButton from "@/Components/ShareButton";
export default {
    name: "BioLayout",
    components: {
        ShareButton
    }
}
</script>

<style scoped>

</style>
