<template>
    <div :class="wrapperClass">
        <flat-pickr
            v-model="date" :config="config"></flat-pickr>
    </div>
</template>

<script>
import flatPickr from 'vue-flatpickr-component';
import moment from 'moment'
import 'flatpickr/dist/flatpickr.css';

export default {
    name: "DateTime",
    props:{
       classes:{
           type: String,
           default:''
       },
        wrapperClass:{
           type: String,
            default: ''
        }
    },
    data () {
        return {
            date: null,
            config: {
                enableTime: true,
                altFormat: 'F j, Y H:i',
                altInput: true,
                dateFormat: 'Y-m-d H:i',
            },
        }
    },
    components: {
        flatPickr
    },
    created() {
        this.date = moment().format()
    },
    mounted() {
        const dateTimeInput = this.$el.querySelector('.form-control')
        dateTimeInput.classList.remove('form-control')
        dateTimeInput.classList.remove('input')
        if (this.classes.length){
            const classListArray = this.classes.split(' ')
            this.$nextTick(() =>{
                dateTimeInput.classList.add(...classListArray)
            })
        }
    }
}
</script>

<style scoped>

</style>
