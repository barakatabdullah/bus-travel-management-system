import api from "@/config/axios"

export async function getUsers(){
    const userStore = useUserStore()
    const {data} = await api.get('users', {
        headers: { Authorization: `Bearer ${userStore.user.token}` }
      })
      return data
}