<script setup lang="ts">
import { useMutation } from "@tanstack/vue-query";
import { useUserStore } from "@/stores/user";
import api from "@/config/axios";
const userStore = useUserStore();

const email = ref("");
const password = ref("");
const router = useRouter();

// Mutation
const { mutate } = useMutation({
  mutationFn: async () => {
    const res = await api
      .post("login", {
        email: email.value,
        password: password.value,
      })
      .then((res) => res.data);
    return res;
  },
  onSuccess: (res) => {
    // Invalidate and refetch
    // queryClient.invalidateQueries({ queryKey: ['todos'] })
    userStore.user.name = res.data?.user.name;
    userStore.user.role = res.data?.roles[0];
    userStore.user.token = res.data?.token;
    localStorage.setItem("name", res.data?.user.name);
    localStorage.setItem("role", res.data?.roles[0]);
    localStorage.setItem("token", res.data?.token);
    router.push({ name: "Dashboard" });
  },
});

function onSubmit() {
  mutate();
}
</script>

<template>
  <div class="w-screen h-screen flex items-center justify-center">
    <Card class="w-2/8">
      <template #content>
        <h3 class="text-center mb-8 font-bold text-8">Login</h3>
        <form class="flex flex-col gap-8 w-full">
          <div class="flex flex-col gap-2">
            <label class="font-bold" for="email">Email</label>
            <InputText id="email" v-model="email" />
          </div>

          <div class="flex flex-col gap-2">
            <label class="font-bold" for="password">Password</label>
            <Password
              :feedback="false"
              :pt="{
                input: { root: { class: 'w-full' } },
              }"
              v-model="password"
              inputId="password"
            />
          </div>

          <Button label="Login" :onclick="() => onSubmit()" />
        </form>
      </template>
    </Card>
  </div>
</template>

<route lang="yaml">
name: Login
meta:
  requiresAuth: false
</route>
