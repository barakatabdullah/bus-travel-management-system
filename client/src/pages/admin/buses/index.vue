<script setup lang="ts">
import api from '@/config/axios';
import { useQuery } from '@tanstack/vue-query';
import { useBusesStore } from './_store';

const userStore = useUserStore()
const busesStore = useBusesStore()


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
    busesStore.getBuses()
  })





      


</script>

<template>
    <div class="container mx-auto py-8 flex flex-col gap-4">
        <h2 class="font-bold text-5">BUSES</h2>


        <DataTable class="rounded-lg border overflow-hidden" :value="busesStore.buses" stripedRows >
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
           
            <Column filed="id" >
                <template #body="slotProps">
            <Button
            text
            icon="i-tabler-edit"
            />
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