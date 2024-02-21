<script>
    import Main from "@/layouts/App.svelte";
    import { jsonRender } from "@/utils";
</script>

<Main class="h-screen flex flex-col items-center --justify-center gap-4">
    <h1 class="text-hero">Home</h1>
    <p class="my-4 bg-neon-100 shadow-sm rounded-full">
        <a class="inline-block p-4" target="_blank" href="/request-docs">
            request-docs
        </a>
    </p>

    <section class="grid grid-cols-4 gap-4 dark">
        <div class="bg-neon-400">bg-neon-400</div>
        <div class="bg-neon-500">bg-neon-500</div>
        <div class="bg-neon-600">bg-neon-600</div>
        <div class="bg-neon-700">bg-neon-700</div>
        <div class="bg-neon-800">bg-neon-800</div>
        <div class="bg-neon-900">bg-neon-900</div>
        <div class="bg-neon-950">bg-neon-950</div>
    </section>

    <section class="grid grid-cols-4 gap-4 light">
        <div class="bg-neon-50">bg-neon-50</div>
        <div class="bg-neon-100">bg-neon-100</div>
        <div class="bg-neon-150">bg-neon-150</div>
        <div class="bg-neon-200">bg-neon-200</div>
        <div class="bg-neon-250">bg-neon-250</div>
        <div class="bg-neon-300">bg-neon-300</div>
        <div class="bg-neon-350">bg-neon-350</div>
    </section>
</Main>

<style>
    div {
        @apply rounded-full py-4 px-6 border border-white text-center;
    }
    section.dark {
        @apply text-white;
    }
</style>
