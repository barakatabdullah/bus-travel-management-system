<script setup lang="ts">

import { useQuery } from '@tanstack/vue-query'
import { getBuses } from './_utils';

const { data } = useQuery({
  queryKey: ['buses'],
  queryFn: getBuses,
  select:(data)=>data.data

})
</script>

<template>
  <div class="container mx-auto py-8 flex flex-col gap-4">
    <h2 class="font-bold text-5">BUSES</h2>

    <DataTable class="rounded-lg border overflow-hidden" :value="data" stripedRows>
      <Column filed="deriver" header="Driver">
        <template #body="slotProps">
          {{ slotProps.data.deriver }}
        </template>
      </Column>
      <Column filed="capacity" header="Capacity">
        <template #body="slotProps">
          {{ slotProps.data.capacity }}
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
name: Buses
meta:
  requiresAuth: true
  layout: admin
</route>
