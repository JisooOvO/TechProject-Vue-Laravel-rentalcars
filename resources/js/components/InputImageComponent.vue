<template>
    <div class="w-full mb-4 flex flex-col justify-center">
        <label @change="handleChange" :for="name" class="block mb-3">
            {{ title }}
            <span class="text-red-500">*</span>
        <input :id="name" type="file" :name="name"
            class="hidden min-h-12 border shadow-inner rounded-md px-2"/>
        <div class="mt-3 h-[20rem] border rounded-md shadow-inner flex justify-center items-center hover:cursor-pointer hover:opacity-80">
            <img id="img" :src="image_path" :alt="image_name" class="hidden object-fill w-full h-full"/>
            <p id="upload" class="text-gray-500">클릭하여 사진을 업로드</p>
        </div>
        </label>
    </div>
</template>

<script>
export default {
    props: {
        name : {
            type: String,
            default: "name",
        },
        type : {
            type: String,
            default: "text",
        },
        title: {
            type: String,
            default: "title"
        },
        placeholder: {
            type: String,
            default: "",
        },
        image_path : {
            type: String,
            default: "",
        },
        image_name : {
            type: String,
            default: "",
        }
    },
    methods: {
        handleChange(event){
            const selectedFile = event.target.files[0];
            const img = document.querySelector("#img");
            const upload = document.querySelector("#upload");
            if(selectedFile){
                const allowedExts = ['.jpg', '.jpeg', '.png'];
                const ext = selectedFile.name.slice(((selectedFile.name.lastIndexOf(".") - 1) >>> 0) + 2).toLowerCase();
            
                if (allowedExts.includes(`.${ext}`)) {
                    const reader = new FileReader();

                    reader.onload = (e) => {
                        img.classList.remove("hidden");
                        upload.classList.add("hidden");
                        img.src = e.target.result;
                    };

                    reader.readAsDataURL(selectedFile);
                }else {
                    alert("확장자는 jpg, jpeg, png 를 허용합니다.");
                }
            }
        }
    }
};
</script>