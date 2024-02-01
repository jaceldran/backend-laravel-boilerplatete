<script>
    import Icon from "@/components/Icon.svelte";
    import { faHome, faAnglesRight } from "@fortawesome/free-solid-svg-icons";
    import { inertia } from "@inertiajs/svelte";

    export let links;
</script>

<nav class="flex justify-between {$$props.class}">
    <section class="flex text-neutral-500 tracking-tighter">
        <a use:inertia href="/">
            <Icon icon={faHome} class="" />
        </a>
        {#each links as link}
            <a use:inertia href={link.href}>
                <Icon icon={faAnglesRight} class="mx-2 " />
                <span>{link.text}</span>
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
