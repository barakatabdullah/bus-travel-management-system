<script setup lang="ts">

import { useQuery } from '@tanstack/vue-query'
import { getTrips } from './_utils';

const { data } = useQuery({
  queryKey: ['trips'],
  queryFn: getTrips,
  select:(data)=>data.data

})


</script>

<template>
  <div class="container mx-auto py-8 flex flex-col gap-4">
    <h2 class="font-bold text-5">TRIPS</h2>

    <DataTable class="rounded-lg border overflow-hidden" :value="data" stripedRows>
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
