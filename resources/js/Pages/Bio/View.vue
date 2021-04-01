<template>
    <div
        class="min-h-screen"
        :style="`background:${styles.background}`"
    >
        <div class="grid grid-col-6">
            <div class="flex flex-col items-center pt-16">
            <span class="inline-block h20 w-20 rounded-full overflow-hidden bg-gray-100">
              <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/>
              </svg>
            </span>
                <p class="p-5 px-4 text-center text-green-50 text-sm" :style="`color:${styles.textColor}`">
                    {{ bio.description }}
                </p>
            </div>
            <div class="flex flex-col">
                <a v-for="(link,index) in bio.links" :key="index"
                   :href="link.url"
                   v-show="link.title"
                   class="border-2 border-green-100 p-2 mb-5 rounded mx-5
                       text-center shadow-sm bg-green-200 flex items-center justify-center"
                   :style="`background:${styles.linkColor}; color:${styles.linkTextColor}`"
                >
                   <template v-if="link.svg.markup">
                       <inline-svg
                           :markup="link.svg.markup"
                           removeAttributes="true"
                           classes="w-8 h-8 mr-2"
                       />
                   </template> <div>{{ link.title }}</div>
                </a>
            </div>
        </div>

    </div>

</template>

<script>
import InlineSvg from "../../Components/InlineSvg";
export default {
    name: "View",
    components: { InlineSvg },
    props: ['user', 'bio'],
    data() {
        return {
            styles: {}
        }
    },
    created() {
        this.$emitter.on('new-link-added', () => {
            location.reload()
        })

    },
    mounted() {
        window.addEventListener('message', (e) => {
            let messageData = e.data
            if (e.origin === 'http://localhost') {
                this.styles = messageData
            }
        });

    }
}
</script>

<style>
nav {
    display: none;
}

.bg-green-500 {
    background: #10B981;
}

.text-white {
    color: #ECFDF5;
}

.layout-1 {
    background: green;
}

.layout-2 {
    background: red;
}

.layout-3 {
    background: blue;
}
</style>
