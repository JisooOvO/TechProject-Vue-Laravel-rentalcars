<template>
    <div class="w-full flex flex-col justify-center">
        <label :for="name" class="block mb-3">{{ title }}</label>
        <textarea :id="name" :type="type" :name="name" :placeholder="placeholder"
            :style="{height: height + 'rem' }"
            class="min-h-12 border shadow-inner rounded-md p-2"></textarea>
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
        height: {
            type: String,
            default: "3",
        }
    }
};
</script>