<script>
    import { inertia } from "@inertiajs/svelte";
    import { createEventDispatcher } from "svelte";

    export let routes;
    export let buttonValue;

    const dispatch = createEventDispatcher();

    const handleClick = (evt) => {
        dispatch("click", { value: evt.target.value });
    };
</script>

<nav class={$$props.class}>
    {#each routes as { text, href, target, active, value }}
        {#if !href}
            <button
                {value}
                on:click={handleClick}
                class={buttonValue === value ? "active" : ""}
            >
                {text}
            </button>
        {/if}
        {#if href}
            <a
                use:inertia
                target={target || "_self"}
                {href}
                class={active ? "active" : ""}
            >
                <span class="text">{text}</span>
            </a>
        {/if}
    {/each}
</nav>

<style>
    nav {
        @apply flex justify-center;
    }
    nav.main {
        @apply h-10;
    }
    nav.subnav {
        @apply h-9;
    }
    nav.horizontal {
        @apply flex-row;
    }
    nav.vertical {
        @apply flex-col;
    }
    nav a {
        @apply flex justify-center items-center py-2 px-4;
    }
    nav a:hover {
        @apply text-neon-300;
    }
    nav.main a {
        @apply rounded-full;
    }
    nav.main a.active {
        @apply bg-neon-500 text-white;
    }
    /* nav.subnav a,
    nav.subnav button {
        padding-left: 0 !important;
        padding-right: 0 !important;
    } */
    nav.subnav a.active,
    nav.subnav button.active {
        @apply underline underline-offset-4;
        text-decoration-thickness: 4px;
    }
    nav.subnav a,
    nav.subnav button {
        @apply px-2 font-bold;
        font-variant: small-caps;
        text-transform: lowercase;
    }
</style>
