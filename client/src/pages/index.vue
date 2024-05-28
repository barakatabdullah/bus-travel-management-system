<script setup>
import HomeNavBar from '@/components/home/HomeNavBar.vue';
import Hero from '@/components/home/Hero.vue'
</script>

<template>
    <!-- NavBar  -->
    <HomeNavBar />
    <!-- Hero  -->
    <Hero />
</template>

<route lang="yaml">
  meta:
    layout: home
</route>