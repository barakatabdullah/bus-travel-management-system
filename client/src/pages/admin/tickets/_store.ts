
import { defineStore } from 'pinia'
import { useRouter } from 'vue-router'
import { useUserStore } from '@/stores/user'
import api from '@/config/axios'

const router = useRouter()

export const useTicketsStore = defineStore('Tickets', {
  state: () => {
    return {
      tickets:null ,
    }
  },
  actions: {

      async getTickets(){
        const userStore=useUserStore()
    const res = await api.get('ticket', {
        
        headers: { Authorization: `Bearer ${userStore.user.token}` }
      });
      this.tickets = res.data?.data
}

  },
})



