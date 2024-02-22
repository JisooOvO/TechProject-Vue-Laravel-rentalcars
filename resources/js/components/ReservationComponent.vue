<template>
    <td class="text-center border h-12">{{ reservation.start_at }}</td>
    <td class="text-center border h-12">{{ reservation.end_at }}</td>
    <td class="text-center border h-12">{{ getStatus }}</td>
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
                case "cancel" : return "취소"
                case "reserved" : return "예약 중"
                case "overdue" : return "연체 중"
                case "return" : return "반납"
            }
        }
    }
}
</script>