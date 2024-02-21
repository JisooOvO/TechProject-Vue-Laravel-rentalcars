<script>
export default {
  props: {
    cars: {
      type: Array,
      required: true,
    },
  },
};


</script>

<template>
  <ul>
    <li v-for="car in cars" :key="car.id" class="text-red-500">
      {{ JSON.stringify(car) }}
    </li>
  </ul>
</template>
