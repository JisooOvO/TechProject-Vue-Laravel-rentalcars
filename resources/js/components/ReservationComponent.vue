<template>
    <td :class="getStatusClass">{{ reservation.user_id }}</td>
    <td :class="getStatusClass">{{ reservation.start_at }}</td>
    <td :class="getStatusClass">{{ reservation.end_at }}</td>
    <td :class="getStatusClass">{{ formattedRentalFee }}</td>
    <td :class="getStatusClass">{{ getStatus }}</td>
</template>

<script>
export default {
    props : {
        reservation : {
            type : Object,
            default : () => ({}),
        }
    },
    computed: {
        getStatus() {
            switch(this.reservation.reservation_status) {
                case "canceled" : return "취소"
                case "used" : return "사용 중"
                case "reserved" : return "예약 중"
                case "overdue" : return "연체 중"
                case "done" : return "반납 완료"
            }
        },
        formattedRentalFee() {
            return this.reservation.rental_fee.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
        },
        getStatusClass() {
            return {
                'text-center h-12 border bg-gray-100' : this.reservation.reservation_status === "canceled",
                'text-center h-12 border bg-red-100' : this.reservation.reservation_status === "used",
                'text-center h-12 border bg-blue-100' : this.reservation.reservation_status === "reserved",
                'text-center h-12 border bg-red-200' : this.reservation.reservation_status === "overdue",
                'text-center h-12 border bg-gray-200' : this.reservation.reservation_status === "done",
            }
        }
    }
}
</script>