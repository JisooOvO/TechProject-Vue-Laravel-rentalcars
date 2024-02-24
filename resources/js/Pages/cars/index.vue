<template>
  <h1 class="text-xl">렌터카 검색</h1>
  <hr class="mt-3 mb-10"/>
  <ul>
    <li v-for="car in cars" :key="car.id">
      <carlist-component @button-clicked="handleListClick(car.id, car.available_quantity)" :car="car"/>
    </li>
  </ul>
</template>

<script>
import CarlistComponent from '../../components/CarlistComponent.vue';
export default {
  components : {
    CarlistComponent,
  },
  data(){
    return {
      isAvailable : null,
    }
  },
  props: {
    cars: {
      type: Array,
      required: true,
    },
  },
  methods: {
    handleListClick(id,available_quantity) {
      if(available_quantity <= 0) return;
      window.location.href = `/show/${id}`
    }
  },
  mounted() {
    fetch('/reservations')
    .then(res => res.json())
    .then(data => {
      if(data.status === "fail") alert("데이터 처리 중 에러가 발생했습니다.");
    })
    .catch(() => alert("데이터 처리 중 에러가 발생했습니다."));
  }
};
</script>


