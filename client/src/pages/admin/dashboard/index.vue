<script setup lang="ts">
const userStore = useUserStore()

console.log(userStore.user)
</script>

<template>
  <div class="container mx-auto py-8 flex flex-col gap-4">
    <h2 class="font-bold text-5">DASHBOARD</h2>
  </div>
</template>

<route lang="yaml">
name: Dashboard
meta:
  requiresAuth: true
  layout: admin
</route>
