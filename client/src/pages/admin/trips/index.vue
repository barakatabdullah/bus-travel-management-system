<script setup lang="ts">
import api from '@/config/axios'
import { useQuery } from '@tanstack/vue-query'
import { useTripsStore } from './_store'

const userStore = useUserStore()
const tripsStore = useTripsStore()

// const { data, isLoading, isError, error } = useQuery({
//       queryKey: ['users'],
//       queryFn: async () => {
//         const res = await api.get('users', {
//           headers: { Authorization: `Bearer ${userStore.user.token}` }
//         });
//         return toRaw(res.data.data);
//       },
//     });

onBeforeMount(async () => {
  await tripsStore.getTrips()
})

console.log(tripsStore.trips)
</script>

<template>
  <div class="container mx-auto py-8 flex flex-col gap-4">
    <h2 class="font-bold text-5">TRIPS</h2>

    <DataTable class="rounded-lg border overflow-hidden" :value="tripsStore.trips" stripedRows>
      <Column filed="name" header="Name">
        <template #body="slotProps">
          {{ slotProps.data.name }}
        </template>
      </Column>
      <Column filed="bus" header="Bus">
        <template #body="slotProps">
          {{ slotProps.data.bus_id }}
        </template>
      </Column>
      <Column filed="time" header="Time">
        <template #body="slotProps">
          {{ slotProps.data.time }}
        </template>
      </Column>

      <Column filed="edit">
        <template #body="slotProps">
          <Button text icon="i-tabler-edit" />
        </template>
      </Column>
    </DataTable>
  </div>
</template>

<route lang="yaml">
name: Trips
meta:
  requiresAuth: true
  layout: admin
</route>
