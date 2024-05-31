import { defineStore } from 'pinia'
import { useRouter } from 'vue-router'
import { useUserStore } from '@/stores/user'
import api from '@/config/axios'

const router = useRouter()

export const useBusesStore = defineStore('Buses', {
  state: () => {
    return {
      buses: null
    }
  },
  actions: {
    async getBuses() {
      const userStore = useUserStore()
      const res = await api.get('bus', {
        headers: { Authorization: `Bearer ${userStore.user.token}` }
      })
      this.buses = res.data?.data
    }
  }
})
