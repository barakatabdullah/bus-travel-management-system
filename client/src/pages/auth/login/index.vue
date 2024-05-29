<script setup lang="ts">
import api from '@/config/axios';
import { useMutation, useQuery } from '@tanstack/vue-query';
import axios from 'axios';

const email = ref(null);
const password = ref(null);

// Mutation
const {mutate} = useMutation({
  mutationFn: async ()=>{
    const res= await api.post('login',{

"email":email.value,
"password":password.value,
}).then(res=>res.data)
return res
  },
  onSuccess: () => {
    // Invalidate and refetch
    // queryClient.invalidateQueries({ queryKey: ['todos'] })
    console.log('done')
  },
})

function onSubmit(){
  mutate()
}

</script>

<template>
    <div class="w-screen h-screen flex items-center justify-center">
        <Card>
            <template #content>
                <h3>Login</h3>
            <form class="flex flex-col gap-8">

                <FloatLabel>
                    <InputText id="email" v-model="email" />
                    <label for="email">Email</label>
                </FloatLabel>

                <FloatLabel>
                    <Password v-model="password" inputId="password" />
                    <label for="password">Password</label>
                </FloatLabel>

                <Button label="login" 
                :onclick="()=>onSubmit()"
                />
            </form>

            </template>
        </Card>

    </div>
</template>

<route lang="yaml">
  meta:
    name: login
</route> 