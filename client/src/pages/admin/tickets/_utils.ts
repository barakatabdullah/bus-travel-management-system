import api from "@/config/axios"


export async function getTickets() {
  const userStore = useUserStore()
  const {data} = await api.get('ticket', {
    headers: { Authorization: `Bearer ${userStore.user.token}` }
  })
  return data
}

export async function addTicket(payload: { user_id: number; trip_id: number; status: boolean }) {
  const userStore = useUserStore()
   await api.post(
    'ticket',
    {
      trip_id: payload.trip_id,
      user_id: payload.user_id,
      status: payload.status
    },
    { headers: { Authorization: `Bearer ${userStore.user.token}` } }
  )

  // if (res.status === 201) {
  //   Swal.fire({
  //     title: 'Ticket add successfuly',
  //     icon: 'success'
  //   })
  // } else {
  //   Swal.fire({
  //     title: 'Some Thing went wrong',
  //     icon: 'error'
  //   })
  // }
}
