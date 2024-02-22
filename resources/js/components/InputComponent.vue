<template>
    <div class="w-full mb-4 flex flex-col justify-center">
            <label :for="name" class="block mb-3">
                {{ title }}
                <span class="text-red-500">*</span>
            </label>
        <input :id="name" :type="type" :name="name" :placeholder="placeholder" required
            class="min-h-12 border shadow-inner rounded-md px-2"/>
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
        }
    }
};
</script>