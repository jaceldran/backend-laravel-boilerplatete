<script>
    import Icon from "@/components/ui/Icon.svelte";
    import { faHome, faAnglesRight } from "@fortawesome/free-solid-svg-icons";
    import { inertia } from "@inertiajs/svelte";

    export let links;
</script>

<nav class="flex justify-between items-center h-10 my-2 {$$props.class}">
    <section class="flex tracking-tighter">
        <a use:inertia href="/">
            <Icon icon={faHome} class="dark:text-neon-light-dark" />
        </a>
        {#each links as link}
            <a use:inertia href={link.href} class="hover:underline">
                <Icon icon={faAnglesRight} size="sm" class="mx-1 " />
                <span class="mt-.5 dark:text-neon-light-dark">{link.text}</span>
            </a>
        {/each}
    </section>
    <section>
        <slot />
    </section>
</nav>

<style>
    a {
        @apply flex items-center;
    }
</style>
