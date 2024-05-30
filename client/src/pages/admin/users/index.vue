<script setup lang="ts">
import api from '@/config/axios';
import { useQuery } from '@tanstack/vue-query';
import { useUsersStore } from './_store';

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




usersStore.getUsers()


    console.log(toRaw(usersStore.users))

      


</script>

<template>
    <div class="container mx-auto py-8 flex flex-col gap-4">
        <h2 class="font-bold text-5">USERS</h2>


        <DataTable :value="toRaw(usersStore.users)" stripedRows >
            <Column filed="name" header="Name"/>
        </DataTable>

    </div>
</template>


<route lang="yaml">
name: Users  
meta:
 requiresAuth: true
 layout: admin
</route> 