<script setup lang="ts">
import api from '@/config/axios';
import { useQuery } from '@tanstack/vue-query';
import { useTicketsStore } from './_store';

const userStore = useUserStore()
const ticketsStore = useTicketsStore()





onBeforeMount(() => {
    ticketsStore.getTickets()
  })





      


</script>

<template>
    <div class="container mx-auto py-8 flex flex-col gap-4">
        <h2 class="font-bold text-5">Tickets</h2>


        <DataTable class="rounded-lg border overflow-hidden" :value="ticketsStore.tickets" stripedRows >
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
name: Tickets  
meta:
 requiresAuth: true
 layout: admin
</route> 