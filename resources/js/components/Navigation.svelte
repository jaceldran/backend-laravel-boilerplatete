<script>
    import { inertia } from "@inertiajs/svelte";
    import { colorScheme } from "@/stores/colorScheme.js";
    import Fa from "svelte-fa";
    import {
        faUser,
        faUserAlt,
        faUserAltSlash,
        faUserAstronaut,
        faUserNinja,
    } from "@fortawesome/free-solid-svg-icons";

    export let routes;
</script>

<nav class="flex justify-center h-16 font-semibold {$$props.class}">
    {#each Object.entries(routes) as [uri, route]}
        <a use:inertia href={uri} class={route.active ? "active" : ""}>
            <span class="text"> {route.name}</span>
        </a>
    {/each}
</nav>

<style>
    a {
        @apply flex justify-center items-center;
    }
    a:hover {
        @apply underline;
    }
    a.active {
        @apply underline;
    }
    .text {
        @apply inline-block px-4;
    }
</style>
