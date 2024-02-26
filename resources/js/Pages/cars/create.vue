<template>
    <article class="w-full max-w-[80rem] p-4 sm:p-8 mx-auto border rounded-md shadow-md xl:flex gap-4">
        <section class="w-full xl:grow p-4 bg-slate-200 border rounded-md shadow-md">
            <h2 class="text-xl text-center my-4">기존 차량 정보 불러오기</h2>
            <hr class="my-4"/>
            <div class="h-[20rem] xl:h-[118rem] bg-white overflow-auto border p-4 rounded-md shadow-inner">
                <ul id="car-list"></ul>
            </div>
        </section>
        <form id="car-enroll-form" class="w-full xl:grow p-4">
            <h2 class="text-xl text-center my-4">신규 차량 등록</h2>
            <hr class="my-4"/>
            <p class="text-sm text-end"><span class="text-red-500">*</span> 은 필수 입력 사항입니다.</p>
            <div class="text-sm text-end mb-3 sm:flex sm:gap-1 sm:justify-end">
                <p class="text-red-500">모델 명이 다를 경우</p>
                <p>DB 결과가 다를 수 있습니다.</p>
            </div>
            <input-image-component name="image_path" title="이미지"/>
            <input-component name="name" title="차량명" placeholder="모닝"/>
            <SelectComponent name="brand_id" title="브랜드명"/>
            <input-component name="model_name" title="모델 명" placeholder="더 뉴 모닝"/>
            <SelectComponent name="type_id" title="차 종"/>
            <SelectComponent name="fuel_id" title="엔진"/>
            <input-component name="year" type="number" title="연식" placeholder="2023"/>
            <input-component name="seater" type="number" title="인승" placeholder="5"/>
            <textarea-component name="option" type="textarea" title="옵션" height="8" placeholder="옵션은 쉼표(,)를 이용하여 구분해주세요."/>
            <input-component name="age_limit" type="number" title="최소 운전 허용 나이" placeholder="21"/>
            <input-component name="experience_limit" type="number" title="최소 운전 경력" placeholder="1"/>
            <input-component name="rental_fee" type="number" title="렌트 비용" placeholder="285000"/>
            <input-component name="total_quantity" type="number" title="차량 대수" placeholder="1"/>
            <div class="text-[80%] text-red-500">
                <p>등록시 모델 명이 일치하면 차량 정보가 갱신됩니다.</p>
                <p>단, 차량 대수는 해당 값만큼 더해집니다.</p>
            </div>
            <div class="w-full h-20 my-8">
                <ButtonComponent title="등록하기" type="submit"/>
            </div>
        </form>
    </article>
</template>

<script>
import ButtonComponent from '../../components/ButtonComponent.vue';
import ExistingCarComponent from '../../components/ExistingCarComponent.vue';
import InputComponent from '../../components/InputComponent.vue';
import InputImageComponent from "../../components/InputImageComponent.vue";
import SelectComponent from '../../components/SelectComponent.vue';
import TextareaComponent from '../../components/TextareaComponent.vue';
import { createApp } from "vue";

export default {
    components: {
    InputComponent, SelectComponent, TextareaComponent, InputImageComponent,
    ButtonComponent
},
    mounted() {

        // add car list
        const carList = document.querySelector("#car-list");

        fetch("/cars")
        .then(res => res.json())
        .then(cars => {
            const app = createApp(ExistingCarComponent, {
                cars : cars
            })
                
            app.mount(carList);
        })
        .catch(console.log)

        // add option 
        const type_request = fetch('/types');
        const fuel_request = fetch('/fuels');
        const brand_request = fetch('/brands');

        Promise.all([type_request,fuel_request,brand_request])
        .then(res => {
            return Promise.all([res[0].json(), res[1].json(), res[2].json()])
        })
        .then(dataArray => {
            const typeArray = dataArray[0];
            const fuelArray = dataArray[1];
            const brandArray = dataArray[2];

            typeArray.map(item => {
                const brandOption = document.createElement("option");
                brandOption.value = item.id;
                brandOption.textContent = item.name;

                const brandId = document.querySelector("#type_id");
                brandId.appendChild(brandOption);
            });

            fuelArray.map(item => {
                const typeOption = document.createElement("option");
                typeOption.value = item.id;
                typeOption.textContent = item.name;

                const typeId = document.querySelector("#fuel_id");
                typeId.appendChild(typeOption);
            });

            brandArray.map(item => {
                const brandOption = document.createElement("option");
                brandOption.value = item.id;
                brandOption.textContent = item.name;

                const brandId = document.querySelector("#brand_id");
                brandId.appendChild(brandOption);
            })
        })
        .catch(console.log);

        // add form event
        const form = document.querySelector("#car-enroll-form");

        const handlesubmit = (event) => {
            event.preventDefault();
            const { target } = event;
            const img = document.querySelector("#img");
            const data = Object.fromEntries(new FormData(target).entries());
            const csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;

            if(img.src === "http://127.0.0.1:8000/create") {
                alert("이미지는 필수 사항입니다.");
                return;
            }else{
                fetch(img.src)
                .then(res => res.blob())
                .then(blob => {
                    const reader = new FileReader();
                    reader.onloadend = () => {
                        const base64Data = reader.result.split(',')[1];
                        
                        fetch('/upload', {
                            method : 'post',
                            headers : {
                                'Content-Type': 'application/json; charset=utf-8',
                                'x-csrf-token' : csrf_token,
                            },
                            body : JSON.stringify({
                                "img": base64Data,  
                            })
                        })
                        .then(res => res.json())
                        .then(path => {
                            data.image_path = `/images/${path.image_path}`;
                            data.image_name = data.name + ' 사진';
                            fetch('/cars', {
                                method : 'post',
                                headers : {
                                    "content-type" : "application/json",
                                    'x-csrf-token' : csrf_token,
                                },
                                body : JSON.stringify(data)
                            })
                            .then(res => res.json())
                            .then(data => {
                                if(data.status === "ok") alert("저장되었습니다.");
                                else alert("데이터 처리 중 에러가 발생하였습니다.");
                            })
                            .catch(console.log);
                        })
                        .catch(console.log);
                    }

                    reader.readAsDataURL(blob);
                })
                .catch(console.log)
            }
        }

        form.addEventListener("submit", handlesubmit);
    },
};
</script>