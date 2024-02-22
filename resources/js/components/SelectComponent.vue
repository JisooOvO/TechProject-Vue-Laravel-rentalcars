<template>
    <div class="w-full mb-4 flex flex-col justify-center">
        <label :for="name" class="block mb-3">
            {{ title }}
            <span class="text-red-500">*</span>
        </label>
        <select :id="name" :name="name" 
        class="h-12 border shadow-inner rounded-md px-2"></select>
    </div>
</template>

<script>
export default {
    props: {
        name: {
            type : String,
            default : "name",
        },
        title: {
            type : String,
            default : "title",
        },
    }
}
</script>