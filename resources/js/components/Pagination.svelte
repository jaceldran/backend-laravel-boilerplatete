<script>
    import { inertia } from "@inertiajs/svelte";
    export let links;
</script>

<nav aria-label="Page navigation">
    {#if links && links.length !== 3}
        <nav>
            {#each links as link}
                {#if link.url === null}
                    <a>{@html link.label}</a>
                {:else}
                    <a
                        use:inertia
                        class={link.active ? "active" : ""}
                        href={link.url}>{@html link.label}</a
                    >
                {/if}
            {/each}
        </nav>
    {/if}
</nav>

<style>
    nav {
        @apply w-full flex justify-between;
    }
    a {
        @apply p-4 text-slate-500 font-semibold;
    }
    a.active {
        @apply bg-slate-200 text-slate-700;
    }
    a:hover {
        @apply text-slate-700;
    }
    nav a:first-child {
        @apply flex-1 text-right;
    }
    nav a:last-child {
        @apply flex-1  text-left;
    }
</style>
