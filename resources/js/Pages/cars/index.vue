<template>
  <ul>
    <li v-for="car in cars" :key="car.id">
      <carlist-component @button-clicked="handleListClick(car.id)" :car="car"/>
    </li>
  </ul>
</template>

<script>
import CarlistComponent from '../../components/CarlistComponent.vue';
export default {
  components : {
    CarlistComponent,
  },
  props: {
    cars: {
      type: Array,
      required: true,
    },
  },
  methods: {
    handleListClick(id) {
      window.location.href = `/show/${id}`
    }
  },
};
</script>


