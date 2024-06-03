import api from "@/config/axios"

export async function getBuses() {
  const userStore = useUserStore()
  const {data} = await api.get('bus', {
    headers: { Authorization: `Bearer ${userStore.user.token}` }
  })
  return data
}