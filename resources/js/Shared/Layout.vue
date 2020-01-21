<template>
    <div class="text-gray-800">
        <navbar />

        <main>
            <slot />
        </main>
    </div>
</template>

<script>
import Navbar from '@/Shared/Navbar'

export default {
     components: {
         Navbar,
     }
}
</script>
