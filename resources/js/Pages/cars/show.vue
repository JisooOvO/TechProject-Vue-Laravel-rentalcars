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
            </div>
        </div>
        <!-- 
            todo
            
            예약은 reservation page에서하기
            렌탈비용 누락
            예약하기 버튼 하단 생성
            예약 현황 스크롤 기능 구현하기
         -->
        <div class="border p-4 mb-8 rounded-md shadow-md">
            <p class="text-xl mb-1">예약 하기</p>
            <flatpickr-component/>
            <hr class="mb-3"/>
        </div>
        <div class="border p-4 mb-8 rounded-md shadow-md">
            <p class="text-xl mb-1">예약 현황</p>
            <hr class="mb-3"/>
            <table class="w-full">
                <thead>
                    <tr class="h-12">
                        <th class="border font-normal">시작 일자</th>
                        <th class="border font-normal">종료 일자</th>
                        <th class="border font-normal">예약 상태</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="reservation in car.reservation">
                        <reservation-component :reservation="reservation"/>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import FlatpickrComponent from '../../components/FlatpickrComponent.vue';
import ReservationComponent from '../../components/ReservationComponent.vue';

export default {
    components: { ReservationComponent, FlatpickrComponent },
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
        }
    },
    mounted() {
        console.log(this.car);
    },
}
</script>