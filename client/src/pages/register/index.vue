<script setup lang="ts">
import { useMutation, useQuery } from '@tanstack/vue-query';
import axios from 'axios';


const name = ref(null);
const email = ref(null);
const phone = ref(null);
const password = ref(null);
const passwordConfirmation = ref(null);



// Mutation
const {mutate} = useMutation({
  mutationFn: ()=>{
    const res= axios.post('http://127.0.0.1:8000/register',{
"username":name.value,
"email":email.value,
"phone":phone.value,
"password":password.value,
"password-confirm":passwordConfirmation.value
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
                <h3>Register</h3>
            <form class="flex flex-col gap-8">
                <FloatLabel>
                    <InputText id="username" v-model="name" />
                    <label for="username">Username</label>
                </FloatLabel>
                <FloatLabel>
                    <InputText id="email" v-model="email" />
                    <label for="email">Email</label>
                </FloatLabel>
                <FloatLabel>
                    <InputNumber id="phone" v-model="phone" />
                    <label for="phone">Phone Number</label>
                </FloatLabel>
                <FloatLabel>
                    <Password v-model="password" inputId="password" />
                    <label for="password">Password</label>
                </FloatLabel>
                <FloatLabel>
                    <Password v-model="passwordConfirmation" inputId="passwordConfirmation" />
                    <label for="passwordConfirmation">Password Confirmation</label>
                </FloatLabel>
                <Button label="register" 
                :onclick="()=>onSubmit()"
                />
            </form>

            </template>
        </Card>

    </div>
</template>