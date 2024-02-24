<template>
    <div>
        <div class="flex gap-4 justify-between">
            <label for="startDate" class="sm:flex sm:gap-2 sm:items-center grow">
                <p class="mb-1 sm:mb-0 whitespace-nowrap">시작일</p>
                <input id="start_at" name="start_at" v-model="startDate" 
                ref="flatpickrInput1" placeholder="2024-01-01" required
                @input="emitStart"
                class="w-full h-10 py-2 px-4 rounded-md shadow-inner border"/>
            </label>
            <label for="endDate" class="sm:flex sm:gap-2 sm:items-center grow">
                <p class="mb-1 sm:mb-0 whitespace-nowrap">종료일</p>
                <input id="end_at" name="end_at" v-model="endDate" 
                ref="flatpickrInput2" placeholder="2024-01-07" required
                @input="emitEnd"
                class="w-full h-10 py-2 px-4 rounded-md shadow-inner border"/>
            </label>
        </div>
    </div>
</template>
  
<script>
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
import ko from "flatpickr/dist/l10n/ko" 

export default {
    data() {
        return {
            startDate: null,
            endDate: null,
        };
    },
    mounted() {
        this.initFlatpickr();
    },
    props : {
        disabledDates : {
            type : Array,
            default : [],
        }
    },
    watch : {
        startDate : "updateFlatpickrInput2MinDate",
        endDate : "updateFlatpickrInput1MaxDate",
    },
    methods: {
        initFlatpickr() {
            const today = new Date();
            const todayString = `${today.getFullYear()}-${today.getMonth() + 1}-${today.getDate() + 1}`;

            flatpickr(this.$refs.flatpickrInput1, {    
                dateFormat: 'Y-m-d',
                minDate: todayString,
                locale: "ko",
                disable : this.disabledDates,
                onChange: function(selectedDates) {
                    this.startDate = selectedDates[0];
                }
            });

            flatpickr(this.$refs.flatpickrInput2, {    
                dateFormat: 'Y-m-d',
                locale: "ko",
                minDate: this.startDate || todayString,
                disable : this.disabledDates,
                onChange: (selectedDates) => {
                    this.endDate = selectedDates[0];
                },
            });
        },

        updateFlatpickrInput1MaxDate() {
            const today = new Date();
            const todayString = `${today.getFullYear()}-${today.getMonth() + 1}-${today.getDate() + 1}`;

            const targetDate = new Date(this.endDate);
            targetDate.setDate(targetDate.getDate()-1)

            this.$refs.flatpickrInput1._flatpickr.set('maxDate', targetDate || todayString);
        },

        updateFlatpickrInput2MinDate() {
            const today = new Date();
            const todayString = `${today.getFullYear()}-${today.getMonth() + 1}-${today.getDate() + 1}`;

            const targetDate = new Date(this.startDate);
            targetDate.setDate(targetDate.getDate()+1)

            this.$refs.flatpickrInput2._flatpickr.set('minDate', targetDate || todayString);
        },

        emitStart(){
            this.$emit('emit-startDate',this.startDate)
        },

        emitEnd(){
            this.$emit('emit-endDate',this.endDate)
        }
    },
};
</script>
  