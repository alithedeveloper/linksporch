<template>
    <div @click.prevent="toggled" class="cursor-pointer">
         <span v-if="status">
           <power-icon-up class="w-5 h-5 text-green"/>
         </span>

          <span v-else>
            <power-icon-down class="w-5 h-5 text-gray-300"/>
          </span>

    </div>
</template>

<script>
import PowerIconDown from "./Icons/PowerIconDown";
import PowerIconUp from "./Icons/PowerIconUp";
import Button from "../Jetstream/Button";

export default {
    name: "PowerToggle",
    emits: ['update:status'],
    props: {
        status: {
            type: Boolean
        }
    },
    components: {
        Button,
        PowerIconUp,
        PowerIconDown
    },
    methods: {
        toggled(val) {
            this.$emit('update:status', !this.status)
        }
    }
}
</script>


