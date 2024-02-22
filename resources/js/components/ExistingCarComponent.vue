<template>
    <li id="list" v-for="(car,index) in cars" :key="car.id" @click="handleClick" 
    class="p-4 my-3 flex flex-col justify-center border rounded-md shadow-md hover:cursor-pointer hover:opacity-80">
        <p class="text-xl mb-2">{{ car.name }}</p>
        <p class="hidden" id="index">{{ index }}</p>
        <p class="text-sm text-gray-500">{{ car.model_name }}</p>
        <div class="flex gap-2 text-sm text-gray-500 whitespace-nowrap text-ellipsis">
            <p>{{ car.brand.name }}</p>
            <p>{{ car.year }}년</p>
        </div>
    </li>
</template>

<script>
export default {
    props : {
        cars : {
            type : Array,
            default : [],
        }
    },
    methods: {
        handleClick(event) {
            const enrollForm = document.querySelector("#car-enroll-form");
            const index = event.target.closest("#list").querySelector("#index").textContent;
            Object.entries(this.cars[index]).forEach(item => {
                const target = enrollForm.querySelector(`#${item[0]}`);
                if(target === null) return;
                if(target.id === "image_path") {
                    const img = document.querySelector("#img");
                    const upload = document.querySelector("#upload");
                    fetch(`/storage${item[1]}`)
                    .then(res => res.blob())
                    .then(data => {
                        img.classList.remove("hidden");
                        upload.classList.add("hidden");
                        img.src = URL.createObjectURL(data);
                    })
                    .catch(console.log)
                }else {
                    target.value = item[1];
                } 
            })
        }
    },
}
</script>