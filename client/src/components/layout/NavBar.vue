<script setup lang="ts">


const navigation = [
    {
        title:'Dashboard',
        name:'Dashboard',
    },
    {
        title:'Users',
        name:'Users',
    }
]
</script>


<template>
    <nav class="w-screen flex items-center justify-center  py-8 bg-[#0a001f]">
        <div class="container mx-auto  flex items-center justify-between">

            <div class="flex gap-4">
                <Button v-for="nav in navigation" :key="nav.name" text :onclick="()=>$router.push({name:nav.name})" :label="nav.title " class="text-white"/>
            </div>

            <div>
                <Button  text :onclick="()=>$router.push({name:'Login'})" icon="i-tabler-door-exit" class="text-white"/>
            </div>
        </div>
    </nav>
</template>
