<script>
    import Icon from "@/components/ui/Icon.svelte";
    import { faHome, faAnglesRight } from "@fortawesome/free-solid-svg-icons";
    import { inertia } from "@inertiajs/svelte";

    export let links;
</script>

<nav
    class="flex justify-between items-center brand-lighter dark:brand-darker border-b px-2 py-2 mt-0 shadow {$$props.class}"
>
    <section class="flex tracking-tight">
        <a use:inertia href="/">
            <Icon icon={faHome} class="dark:text-neon-light-dark" />
        </a>
        {#each links as { text, href }}
            <a use:inertia {href} class="hover:underline">
                <Icon icon={faAnglesRight} size="sm" class="mx-1 " />
                <span class="dark:text-neon-light-dark">{text}</span>
            </a>
        {/each}
    </section>
</nav>

<style>
    a {
        @apply flex items-center text-sm;
    }
</style>
