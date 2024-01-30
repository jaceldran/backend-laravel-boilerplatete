<script>
    import FlashMessage from "@/components/FlashMessage.svelte";
    import DarkModeButton from "@/components/DarkModeButton.svelte";
</script>

<div class="layout">
    <main>
        <FlashMessage />
        <slot />
    </main>
</div>

<style>
    .layout {
        @apply flex flex-col h-svh;
    }
    main {
        @apply flex-1;
    }
</style>
