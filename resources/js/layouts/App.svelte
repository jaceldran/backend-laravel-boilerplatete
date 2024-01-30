<script>
    import { page } from "@inertiajs/svelte";
    import FlashMessage from "@/components/FlashMessage.svelte";
    import DarkModeButton from "@/components/DarkModeButton.svelte";
    import { jsonRender } from "@/utils";

    const user = $page.props.user;
</script>

<div class="layout">
    <header class="dark:bg-stone-900">
        <a
            href="/"
            class="flex items-center justify-center ml-4 py-2 dark:text-amber-500 text-amber-800 font-medium rounded"
            >LOGO</a
        >
        <DarkModeButton />
    </header>

    <main>
        <FlashMessage />
        <pre class="m-4 p-4 border">{jsonRender(user)}</pre>
        <slot />
    </main>

    <footer class="dark:bg-stone-900">[FOOTER]</footer>
</div>

<style>
    .layout {
        @apply flex flex-col h-svh;
    }
    header {
        @apply flex justify-between items-center shadow-md w-full bg-stone-200;
    }
    footer {
        @apply p-4 bg-stone-200;
    }
    main {
        @apply flex-1;
    }
</style>
