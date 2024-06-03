<script setup lang="ts">
import api from '@/config/axios'
import { useMutation, useQuery, useQueryClient } from '@tanstack/vue-query'
import { addTicket, getTickets } from './_utils'
import Swal from 'sweetalert2';
import { getTrips } from '../trips/_utils';
import { getUsers } from '../users/_utils';

const queryClient = useQueryClient()

const visible = ref(false)
const userId = ref()
const tripId = ref()
const status = ref(true)


const { data:tickets } = useQuery({
  queryKey: ['tickets'],
  queryFn: getTickets,

})

const { data:trips } = useQuery({
  queryKey: ['trips'],
  queryFn: getTrips,
  select:(data)=>data.data

})

const { data:users } = useQuery({
  queryKey: ['users'],
  queryFn: getUsers,

})

const { mutate:ticketMutate } = useMutation({
  mutationFn: addTicket,
  onSuccess: ()=>{
    Swal.fire({
      title: 'Ticket add successfuly',
      icon: 'success'
    })
    queryClient.invalidateQueries({ queryKey: ['tickets'] })

  }
})



function onSubmit() {
  {
    ticketMutate({
      user_id: userId.value,
      trip_id: tripId.value,
      status: status.value
    })
    userId.value = null
    tripId.value = null
    visible.value = false
  }
}


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
              :options="trips!"
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
              :options="users!"
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

    <DataTable class="rounded-lg border overflow-hidden" :value="tickets" stripedRows>
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
