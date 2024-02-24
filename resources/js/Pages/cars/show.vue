<template>
    <div class="max-w-[60rem] mx-auto">
        <div class="block sm:flex sm:gap-6 sm:justify-between border mb-8 p-4 rounded-md shadow-md">
            <div class="w-full sm:w-[30%]">
                <img :src="`/storage${car.image_path}`" :alt="car.image_name"
                    class="h-[10rem] mb-5 sm:mb-0 sm:h-full object-fill"/>
            </div>
            <div class="grow">
                <div>
                    <h1 class="text-2xl mb-5 whitespace-nowrap">{{ car.brand.name }}</h1>
                    <h2 class="text-xl whitespace-nowrap">{{ car.name }}</h2>
                    <p class="text-gray-400 mb-3 whitespace-nowrap">{{ car.model_name }}</p>
                    <div class="flex gap-2">
                        <p>{{ car.year }}년</p>
                        <p>{{ car.fuel.name }}</p>
                        <p>{{ car.type.name }}</p>
                        <p>{{ car.seater }}인승</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="border p-4 mb-8 rounded-md shadow-md">
            <div>
                <div class="mb-5">
                    <p class="text-xl mb-1">운전자 제한 조건</p>
                    <hr class="mb-3"/>
                    <div class="flex justify-between">
                        <p>나이 </p>
                        <p>{{ car.age_limit }}세 이상</p>
                    </div>
                    <div class="flex justify-between">
                        <p>운전 경력 </p>
                        <p>{{ car.experience_limit }}년 이상</p>
                    </div>
                </div>
                <div class="mb-5">
                    <p class="text-xl mb-1">차 옵션</p>
                    <hr class="mb-3"/>
                    <p>{{ car.option }}</p>
                </div>
                <div class="flex justify-between text-red-500 my-10 font-bold text-xl">
                    <p>1일 렌탈 비용</p>
                    <p>{{ formattedRentalFee }}원</p>
                </div>
                <div class="w-full h-20">
                    <Link href="/reservation" :data="{ id }">
                        <ButtonComponent title="예약하기"/>
                    </Link>
                </div>
            </div>
        </div>
        <div class="border p-4 mb-8 rounded-md shadow-md">
            <p class="text-xl mb-1">예약 현황</p>
            <hr class="mb-3"/>
            <div class="w-full mb-5">
                <div class="w-full text-blue-500 font-bold flex justify-between">
                    <p>총 차량 수</p>
                    <p>{{ car.total_quantity }} 대</p>
                </div>
                <div class="w-full text-red-500 font-bold flex justify-between">
                    <p>현재 이용 중인 차량 수</p>
                    <p>{{ availableCarNumber }} 대</p>
                </div>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="h-12">
                        <th class="border font-normal">시작 일자</th>
                        <th class="border font-normal">종료 일자</th>
                        <th class="border font-normal">총 렌탈 비용</th>
                        <th class="border font-normal">예약 상태</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="reservation in sortedReservations">
                        <reservation-component :reservation="reservation"/>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import ReservationComponent from '../../components/ReservationComponent.vue';
import ButtonComponent from '../../components/ButtonComponent.vue';


export default {
    components: { ReservationComponent, Link, ButtonComponent },
    props: {
        car: {
            type: Object,
            default: () => ({}),
        }
    },
    computed: {
        reservationStatus() {
            switch (this.car.reservation) {
            }
        },
        formattedRentalFee() {
            return this.car.rental_fee.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
        },
        id() {
            return this.car.id;
        },
        availableCarNumber () {
            let n = 0;
            this.car.reservation.forEach(item => {
                if (item.reservation_status === "used") n = n + 1;
            })
            return n;
        },
        sortedReservations(){
            const sortedArray = this.car.reservation.slice().sort((a,b) => {
                const dateA = new Date(a.start_at);
                const dateB = new Date(b.start_at);
                return dateA - dateB;
            });
            return sortedArray
        }
    },
}
</script>