import { defineStore } from 'pinia'
import { useRouter } from 'vue-router'
import { useUserStore } from '@/stores/user'
import api from '@/config/axios'
import Swal from 'sweetalert2'

const router = useRouter()

export const useTicketsStore = defineStore('Tickets', {
  state: () => {
    return {
      tickets: null
    }
  },
  actions: {
    async getTickets() {
      const userStore = useUserStore()
      const res = await api.get('ticket', {
        headers: { Authorization: `Bearer ${userStore.user.token}` }
      })
      this.tickets = res.data
    },
    async addTicket(payload:{user_id:number,trip_id:number , status:boolean}) {
      
      const userStore = useUserStore()
      const res = await api.post('ticket', {
        trip_id: payload.trip_id,
        user_id:payload.user_id,
        status:payload.status
      },{ headers: { Authorization: `Bearer ${userStore.user.token}` }})

      if (res.status === 201) {
        this.getTickets()
        Swal.fire({
          title: "Ticket add successfuly",
          icon: "success"
        });
      } else {
        Swal.fire({
          title: "Some Thing went wrong",
          icon: "error"
        });
      }
    }
  }
})
