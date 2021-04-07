<template>
    <form :class="wrapperClass" @submit.prevent="onScheduleFormSubmit">
        <flat-pickr
            v-model="dateTime"
            :config="config"
            @on-change="onChangeDate"
        />
        <button
            type="submit" class="w-full items-center justify-center inline-block px-4 py-2 font-medium border border-transparent
        rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 sm:text-sm w-2/5 ml-5 bg-indigo-500 border-2 text-indigo-100
        hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">
            Confirm
        </button>
    </form>
</template>

<script>
import flatPickr from 'vue-flatpickr-component';
import moment from 'moment'
import 'flatpickr/dist/flatpickr.css';

export default {
    name: "DateTime",
    props: {
        classes: {
            type: String,
            default: ''
        },
        wrapperClass: {
            type: String,
            default: ''
        },
        link:{
            type: Object,
            default: {}
        }
    },
    data() {
        return {
            dateTime: this.link.schedule,
            loading:false,
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
    methods: {
        onScheduleFormSubmit(){
            this.loading = true
            axios.post(`/api/link/${this.link.id}/schedule`, { schedule: this.dateTime})
            .then((response) => {
                this.loading = false
            })
            .catch((error) => {})
        },
        onChangeDate(selectedDates, dateStr, instance) {
            // this.onChange({selectedDates, dateStr, instance})
        }
    },
    created() {
        this.date = moment().format()
    },
    mounted() {
        const dateTimeInput = this.$el.querySelector('.form-control')
        dateTimeInput.classList.remove('form-control')
        dateTimeInput.classList.remove('input')
        if (this.classes.length) {
            const classListArray = this.classes.split(' ')
            this.$nextTick(() => {
                dateTimeInput.classList.add(...classListArray)
            })
        }
    }
}
</script>

<style scoped>

</style>
