<script setup>
const router = useRouter()
</script>

<template>
  <div class="absolute bg-[#0a001f] w-screen h-screen max-lg">
    <img class="mix-blend-screen saturate-20 h-full" src="/assets/photos/hero-bg.svg" />
  </div>
  <div
    aria-hidden="true"
    class="absolute h-screen justify-between items-center inset-0 grid grid-cols-2 -space-x-52 z-0"
  >
    <div
      class="blur-[150px] -ms-10 mt-auto w-2/6 h-1/3 bg-gradient-to-r from-[#4833cc] to-[rgb(176,28,255)] opacity-80"
    ></div>
    <div class="w-full h-full flex items-center justify-end">
      <div
        class="blur-[150px] w-1/3 h-1/2 bg-gradient-to-r from-[#4833cc] to-[rgb(176,28,255)] opacity-90"
      ></div>
    </div>
  </div>
  <section
    class="relative container mx-auto min-h-screen grid grid-cols-2 gap-12 items-center z-10 max-lg:grid-cols-1 max-lg:text-center max-lg:pt-28 max-lg:px-4"
  >
    <div class="flex flex-col gap-8 items-start col-span-1 max-lg:items-center max-lg:px-10">
      <h1 class="text-6xl leading-snug font-bold block text-white max-lg:text-3xl">
        <span class="text-[#4833cc]">Lorem ipsum</span> dolor sit amet, consectetur adipiscing elit,
      </h1>
      <p class="text-gray-3 text-lg max-lg:text-3.2 leading-snug">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit,Lorem ipsum dolor sit amet,
        consectetur adipiscing elit.
      </p>
      <div class="flex gap-4">
        <Button label="Get your offer" :onclick="() => router.push({ name: 'Tickets' })" outlined />
      </div>
    </div>
    <div class="col-span-1 py-8">
      <img class="ms-auto w-10/12 max-lg:mx-auto" src="/assets/photos/hero.svg" alt="" />
    </div>
  </section>
</template>

<route lang="yaml">
name: Home
</route>
