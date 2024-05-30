<script setup>

import { useRoute, useRouter } from 'vue-router'


const route = useRoute()
const router = useRouter()



router.push({name:"Login"})
</script>
