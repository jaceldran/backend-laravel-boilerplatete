<script>
    import Icon from "@/components/Icon.svelte";
    import { faHome, faAnglesRight } from "@fortawesome/free-solid-svg-icons";
    import { inertia } from "@inertiajs/svelte";

    export let links;
</script>

<nav class={$$props.class}>
    <a use:inertia href="/">
        <Icon icon={faHome} class="text-neutral-700" />
    </a>
    {#each links as link}
        <a use:inertia href={link.href}>
            <Icon icon={faAnglesRight} class="mx-2 " />
            <span>{link.text}</span>
        </a>
    {/each}
</nav>

<style>
    nav {
        @apply flex py-2 border-b text-neutral-400 text-sm font-semibold tracking-tighter;
    }
    a {
        @apply flex items-center;
    }
</style>
