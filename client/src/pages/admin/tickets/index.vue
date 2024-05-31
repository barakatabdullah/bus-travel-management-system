<script setup lang="ts">
import api from '@/config/axios'
import { useQuery } from '@tanstack/vue-query'
import { useTicketsStore } from './_store'
import { useTripsStore } from '../trips/_store'
import { useUsersStore } from '../users/_store'

const userStore = useUserStore()
const usersStore = useUsersStore()
const tripsStore = useTripsStore()
const ticketsStore = useTicketsStore()
const visible = ref(false)
const userId = ref()
const tripId = ref()
const status = ref(true)

onBeforeMount(() => {
  ticketsStore.getTickets()
  tripsStore.getTrips()
  usersStore.getUsers()
})

async function onSubmit() {
  {
    await ticketsStore.addTicket({
      user_id: userId.value,
      trip_id: tripId.value,
      status: status.value
    })
    userId.value = null
    tripId.value = null
    visible.value = false
  }
}

console.log(ticketsStore.tickets)
</script>

<template>
  <div class="container mx-auto py-8 flex flex-col gap-4">
    <div class="flex items-center justify-between">
      <h2 class="font-bold text-5">Tickets</h2>
      <div class="card flex justify-content-center">
        <Button label="Add Ticket" @click="visible = true" />
        <Dialog v-model:visible="visible" modal header="New Ticket" :style="{ width: '25rem' }">
          <span class="p-text-secondary block mb-5">Update your information.</span>
          <div class="flex items-center gap-3 mb-3">
            <label for="trip" class="font-semibold w-6rem">Trip</label>
            <Dropdown
              placeholder="Trips"
              class="w-full"
              v-model="tripId"
              :options="tripsStore.trips!"
              optionLabel="name"
              optionValue="id"
              id="trip"
            />
          </div>
          <div class="flex items-center gap-3 mb-3">
            <label for="passenger" class="font-semibold w-6rem">Passenger</label>
            <Dropdown
              placeholder="Passengers"
              class="w-full"
              v-model="userId"
              :options="usersStore.users!"
              optionLabel="name"
              optionValue="id"
              id="passenger"
            />
          </div>
          <div class="flex items-center gap-3 mb-3">
            <label for="trip" class="font-semibold w-6rem">Trip</label>
            <InputSwitch v-model="status" />
          </div>
          <div class="flex justify-content-end gap-2">
            <Button
              type="button"
              label="Cancel"
              severity="secondary"
              @click="visible = false"
            ></Button>
            <Button type="button" label="Add" @click="onSubmit"></Button>
          </div>
        </Dialog>
      </div>
    </div>

    <DataTable class="rounded-lg border overflow-hidden" :value="ticketsStore.tickets" stripedRows>
      <Column filed="" header="Number">
        <template #body="slotProps">
          {{ slotProps.data.id }}
        </template>
      </Column>
      <Column filed="trip" header="Trip">
        <template #body="slotProps">
          {{ slotProps.data.trip.name }}
        </template>
      </Column>
      <Column filed="user" header="Passenger">
        <template #body="slotProps">
          {{ slotProps.data.user.name }}
        </template>
      </Column>

      <Column filed="id">
        <template #body="slotProps">
          <Button text icon="i-tabler-edit" />
        </template>
      </Column>
    </DataTable>
  </div>
</template>

<route lang="yaml">
name: Tickets
meta:
  requiresAuth: true
  layout: admin
</route>
