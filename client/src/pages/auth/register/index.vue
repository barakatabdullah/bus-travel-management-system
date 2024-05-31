<script setup lang="ts">
import api from '@/config/axios'
import { useMutation } from '@tanstack/vue-query'

const name = ref(null)
const email = ref(null)
const phone = ref(null)
const password = ref(null)
const passwordConfirmation = ref(null)

// Mutation
const { mutate } = useMutation({
  mutationFn: async () => {
    const res = await api
      .post('register', {
        username: name.value,
        email: email.value,
        phone: phone.value,
        password: password.value,
        password_confirmation: passwordConfirmation.value
      })
      .then((res) => res.data)
    return res
  },
  onSuccess: (data) => {
    // Invalidate and refetch
    // queryClient.invalidateQueries({ queryKey: ['todos'] })
    console.log('data')
  }
})

function onSubmit() {
  mutate()
}
</script>

<template>
  <div class="w-screen h-screen flex items-center justify-center">
    <Card class="w-2/8">
      <template #content>
        <h3 class="text-center mb-8 font-bold text-8">Register</h3>
        <form class="flex flex-col gap-8 w-full">
          <div class="flex flex-col gap-2">
            <label class="font-bold" for="username">Username</label>
            <InputText id="username" v-model="name" />
          </div>
          <div class="flex flex-col gap-2">
            <label class="font-bold" for="email">Email</label>
            <InputText id="email" v-model="email" />
          </div>
          <div class="flex flex-col gap-2">
            <label class="font-bold" for="phone">Phone Number</label>
            <InputNumber id="phone" v-model="phone" />
          </div>
          <div class="flex flex-col gap-2">
            <label class="font-bold" for="password">Password</label>
            <Password
              :pt="{
                input: { root: { class: 'w-full' } }
              }"
              v-model="password"
              inputId="password"
            />
          </div>
          <div class="flex flex-col gap-2">
            <label class="font-bold" for="passwordConfirmation">Password Confirmation</label>
            <Password
              :pt="{
                input: { root: { class: 'w-full' } }
              }"
              v-model="passwordConfirmation"
              inputId="passwordConfirmation"
            />
          </div>
          <Button label="Register" :onclick="() => onSubmit()" />
        </form>
      </template>
    </Card>
  </div>
</template>

<route lang="yaml">
name: Register
meta:
  requiresAuth: false
</route>
