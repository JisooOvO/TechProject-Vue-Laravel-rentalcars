<template>
    <li @click="handleClick" class="w-full min-h-12 p-4 mb-4 border rounded-md shadow-md sm:flex sm:gap-4 hover:cursor-pointer hover:opacity-80">
        <div class="sm:w-[30%] mb-3 sm:mb-0">
            <img :src="`/storage${car.image_path}`" :alt="car.image_name" 
            class="w-full h-full object-fill min-h-40"/>
        </div>
        <div class="grow">
            <p class="text-xl mb-3 whitespace-nowrap">{{ car.name }}</p>
            <div class="flex gap-2 text-sm text-gray-500 mb-2">
                <p class="whitespace-nowrap">{{ car.model_name }}</p>
            </div>
            <div class="flex gap-2 text-sm text-gray-500 mb-2">
                <p class="whitespace-nowrap">{{ car.year }}년</p>
                <p class="whitespace-nowrap">{{ car.seater }}인승</p>
                <p class="whitespace-nowrap">{{ car.age_limit }}세 이상</p>
                <p class="whitespace-nowrap">{{ car.experience_limit }}년 이상</p>
            </div>
            <div class="flex gap-2 text-sm text-gray-500 mb-3">
                <p>{{ car.brand.name }}</p>
                <p>{{ car.type.name }}</p>
                <p>{{ car.fuel.name }}</p>
            </div>
            <div class="min-h-12 my-5 text-gray-700">
                <p>{{ car.option }}</p>
            </div>
            <div class="flex gap-10 justify-between items-center">
                <div class="grow">
                    <div class="sm:text-xl flex justify-between whitespace-nowrap">
                        <p class="text-blue-500 font-bold">1일 렌탈 비용</p>
                        <p class="text-blue-500 font-bold">{{ formattedRentalFee }}원</p>
                    </div>
                </div>
                <div class="w-44 h-16">
                    <button-component title="예약 정보 확인"/>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
import ButtonComponent from './ButtonComponent.vue';

export default {
    props: {
        car: {
            type: Object,
            default: () => ({}),
        }
    },
    computed: {
        formattedRentalFee() {
            return this.car.rental_fee.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
        }
    },
    methods: {
        handleClick() {
            this.$emit("button-clicked");
        }
    },
    components: { ButtonComponent }
}
</script>