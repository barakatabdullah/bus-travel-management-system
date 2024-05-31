<script setup lang="ts">
import api from '@/config/axios'
import { useQuery } from '@tanstack/vue-query'
import { useUsersStore } from './_store'

const userStore = useUserStore()
const usersStore = useUsersStore()

// const { data, isLoading, isError, error } = useQuery({
//       queryKey: ['users'],
//       queryFn: async () => {
//         const res = await api.get('users', {
//           headers: { Authorization: `Bearer ${userStore.user.token}` }
//         });
//         return toRaw(res.data.data);
//       },
//     });

onBeforeMount(() => {
  usersStore.getUsers()
})

console.log(usersStore.users)
</script>

<template>
  <div class="container mx-auto py-8 flex flex-col gap-4">
    <h2 class="font-bold text-5">USERS</h2>

    <DataTable class="rounded-lg border overflow-hidden" :value="usersStore.users" stripedRows>
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
