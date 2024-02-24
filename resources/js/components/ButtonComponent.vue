<template>
    <button :type="type" :class="getStyle">
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
        },
        color : {
            type : String,
            default : "bg-blue-500"
        }
    },
    computed : {
        getStyle() {
            return `w-full h-full text-white text-xl font-bold ${this.color} rounded-md shadow-md hover:opacity-80`;
            
        }
    }
}
</script>