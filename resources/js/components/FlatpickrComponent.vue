<template>
    <form>
        <label for="dates">
            <input name="dates" v-model="selectedDate" ref="flatpickrInput"
            class="w-full shadow-inner border"
            />
        </label>
    </form>
</template>
  
<script>
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
  
export default {
    data() {
        return {
            selectedDate: null,
        };
    },
    mounted() {
        this.initFlatpickr();
    },
    methods: {
        initFlatpickr() {
            flatpickr(this.$refs.flatpickrInput, {
                mode: 'range',
                dateFormat: 'Y-m-d',
                enableTime: false,
                disable: [
                    {from : '2024-02-25', to: '2024-02-28'},
                    {from : '2024-02-13', to: '2024-02-15'},
                ]
            });
        },
    },
};
</script>
  