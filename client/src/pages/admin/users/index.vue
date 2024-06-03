<script setup lang="ts">
import { useQuery } from '@tanstack/vue-query'
import { getUsers } from './_utils';

const { data } = useQuery({
  queryKey: ['users'],
  queryFn: getUsers,

})


</script>

<template>
  <div class="container mx-auto py-8 flex flex-col gap-4">
    <h2 class="font-bold text-5">USERS</h2>

    <DataTable class="rounded-lg border overflow-hidden" :value="data" stripedRows>
      <Column filed="name" header="Name">
        <template #body="slotProps">
          {{ slotProps.data.name }}
        </template>
      </Column>
      <Column filed="email" header="Email">
        <template #body="slotProps">
          {{ slotProps.data.email }}
        </template>
      </Column>
      <Column filed="phone" header="Phone">
        <template #body="slotProps">
          {{ slotProps.data.phone }}
        </template>
      </Column>
      <Column filed="role" header="Role">
        <template #body="slotProps">
          {{ slotProps.data?.roles[0].name }}
        </template>
      </Column>
      <Column filed="phone">
        <template #body="slotProps">
          <Button text icon="i-tabler-edit" />
        </template>
      </Column>
    </DataTable>
  </div>
</template>

<route lang="yaml">
name: Users
meta:
  requiresAuth: true
  layout: admin
</route>
