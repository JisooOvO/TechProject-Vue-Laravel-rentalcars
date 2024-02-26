<template>
    <form @submit="handleSubmit" class="max-w-[40rem] mx-auto border p-4 mb-8 rounded-md shadow-md">
        <h1 class="text-2xl">예약 신청서</h1>
        <hr class="my-3"/>
        <p class="text-sm text-end"><span class="text-red-500">*</span> 은 필수 입력 사항입니다.</p>
        <div>
            <p class="my-5">희망 차종 <span class="text-red-500"> *</span></p>
            <div class="w-full px-4 py-2 border rounded-md shadow-inner">
                <p class="mb-2">{{ car.brand.name }}</p>
                <p>{{  car.model_name }}</p>
            </div>
        </div>
        <div class="mb-5">
            <p class="my-5">
                예약 날짜 
                <span class="text-gray-500">(YYYY-MM-DD)</span>
                <span class="text-red-500"> *</span>
            </p>
            <div>
                <flatpickr-component v-if="getIsReservationLimit" :disabledDates="getDisableArray" 
                @emit-startDate="updateStartDate"
                @emit-endDate="updateEndDate"/>
                <flatpickr-component v-else 
                @emit-startDate="updateStartDate"
                @emit-endDate="updateEndDate"/>
            </div>
        </div>
        <div class="mb-5 flex justify-between text-red-500 font-bold">
            <p>총 렌탈 비용</p>
            <p id="rental_fee">{{ getRentalFee }}원</p>
        </div>
        <textarea-component 
        title="추가 정보" height="10" placeholder="서울 여행" name="additional_information">
        </textarea-component>
        <div class="w-full h-20 my-8">
            <ButtonComponent title="예약하기" type="submit"/>
        </div>
    </form>
</template>

<script>
import ButtonComponent from '../../components/ButtonComponent.vue';
import FlatpickrComponent from '../../components/FlatpickrComponent.vue';
import TextareaComponent from '../../components/TextareaComponent.vue';

export default{
    components : {
        FlatpickrComponent,
        TextareaComponent,
        ButtonComponent
    },
    props: {
        car : {
            type : Object,
            default : () => ({}),
        },
    },
    computed: {
        getIsReservationLimit () {
            return this.car.reservation
            .filter(reservation => reservation.reservation_status === 'reserved').length >= this.car.available_quantity;
        },
        getDisableArray () {
            return this.car.reservation
            .filter(reservation => reservation.reservation_status === 'reserved')
            .map(reservation => {
                return { 
                    from : new Date(reservation.start_at).toISOString().slice(0,10), 
                    to : new Date(reservation.end_at).toISOString().slice(0,10), 
                } 
            });
        },
        getRentalFee(){
            const dateDifferent = ( new Date(this.endDate) - new Date(this.startDate) ) / (24*60*60*1000);
            if(!isNaN(dateDifferent)) return (this.car.rental_fee * +dateDifferent).toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") ;
            else return 0;
        },
    },
    methods: {
        handleSubmit (event) {
            event.preventDefault();
            const { target } = event;
            const formData = Object.fromEntries(new FormData(target).entries());
            const csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
            const rentalFee = document.querySelector("#rental_fee").textContent.slice(0,-1).replace(",","");

            const additionData = {
                "user_id" : 1,
                "car_id" : this.car.id,
                "reservation_status" : "reserved",
                "rental_fee" : rentalFee,
            }

            const data = { ...formData, ...additionData }

            fetch('/reservations', {
                method : 'post',
                headers : {
                    "content-type" : "application/json",
                    'x-csrf-token' : csrf_token,
                },
                body : JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                switch(data.status) {
                    case "ok" : {
                        alert("예약이 성공적으로 완료되었습니다.");
                        window.location.href = "/";
                        break;
                    }
                    case "not_available" : {
                        alert("예약 가능한 차량이 존재하지 않습니다.");
                        break;
                    }
                    default : {
                        alert("데이터 처리 중 에러 발생");
                    }
                }
            })
            .catch(console.log);
        },

        updateStartDate(startDate){
            this.startDate = startDate;
        },

        updateEndDate(endDate){
            this.endDate = endDate;
        }

    },
    data() {
        return {
            startDate : "",
            endDate : "",
        }
    }
}
</script>