<template>
    <button :type="type" 
    class="w-full h-full text-white text-xl font-bold bg-blue-500 rounded-md shadow-md hover:opacity-80">
    {{ title }}
    </button>

</template>

<script>
export default {
    props : {
        type : {
            type : String,
            default : "button",
        },
        title : {
            type : String,
            default : "title",
        }
    }
}
</script>