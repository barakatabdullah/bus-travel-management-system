import api from "@/config/axios"

export async function getTrips() {
  const userStore = useUserStore()
  const {data} = await api.get('trip', {
    headers: { Authorization: `Bearer ${userStore.user.token}` }
  })
  return data
}