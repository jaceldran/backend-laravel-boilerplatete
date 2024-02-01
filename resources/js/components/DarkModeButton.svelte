<script>
    import { colorScheme } from "@/stores/colorScheme.js";
    import Fa from "svelte-fa";
    import { faMoon, faSun } from "@fortawesome/free-regular-svg-icons";

    function toggle() {
        colorScheme.toggle();
    }
</script>

<button class="flex {$$props.class}" on:click={toggle}>
    {#if $colorScheme === "light"}
        <Fa icon={faMoon} size="lg" />
    {/if}

    {#if $colorScheme === "dark"}
        <Fa icon={faSun} size="lg" />
    {/if}
</button>
