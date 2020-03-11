<template>
    <div class="text-gray-800">
        <navbar />

        <main class="w-full max-w-6xl mx-auto">
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
