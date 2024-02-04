<script>
    import { inertia } from "@inertiajs/svelte";
    import { jsonRender } from "@/utils.js";

    export let data;
</script>

<nav class="w-full dark:bg-neon-dark-darker bg-neon-light-lightest">
    <section class="showing">
        Mostrando {data.from} a {data.to} de {data.total}
    </section>

    <section>
        {#if data.links && data.links.length !== 3}
            <nav>
                {#each data.links as link}
                    {#if link.url === null}
                        <a href="#" class="whitespace-nowrap"
                            >{@html link.label}</a
                        >
                    {:else}
                        <a
                            use:inertia
                            class="whitespace-nowrap {link.active
                                ? 'dark:bg-neon-dark-medium bg-neon-light-light'
                                : ''}"
                            href={link.url}>{@html link.label}</a
                        >
                    {/if}
                {/each}
            </nav>
        {/if}
    </section>
</nav>

<!-- <pre>{jsonRender(data)}</pre> -->

<style>
    nav {
        @apply w-full flex justify-between items-center  px-2 font-medium;
    }
    section {
        @apply py-2;
    }
    a {
        @apply px-2 rounded-full;
    }
    nav a:first-child {
        @apply flex-1 text-right;
    }
    nav a:last-child {
        @apply flex-1  text-left;
    }
</style>
