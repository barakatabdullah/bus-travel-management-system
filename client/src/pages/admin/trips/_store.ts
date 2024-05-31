
import { defineStore } from 'pinia'
import { useRouter } from 'vue-router'
import { useUserStore } from '@/stores/user'
import api from '@/config/axios'

const router = useRouter()

export const useTripsStore = defineStore('Trips', {
  state: () => {
    return {
      trips:null ,
    }
  },
  actions: {

      async getTrips(){
        const userStore=useUserStore()
        const res = await api.get('trip', {
        
        headers: { Authorization: `Bearer ${userStore.user.token}` }
      });
      this.trips = res.data.data
}

  },
})



