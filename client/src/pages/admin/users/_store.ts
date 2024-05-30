
import { defineStore } from 'pinia'
import { useRouter } from 'vue-router'
import { useUserStore } from '@/stores/user'
import api from '@/config/axios'

const router = useRouter()

export const useUsersStore = defineStore('Users', {
  state: () => {
    return {
      users:null ,
    }
  },
  actions: {

      async getUsers(){
        const userStore=useUserStore()
    const res = await api.get('users', {
        
        headers: { Authorization: `Bearer ${userStore.user.token}` }
      });
      this.users = res.data?.data
}

  },
})



