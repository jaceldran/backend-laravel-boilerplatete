<script>
    import { colorScheme } from "@/stores/colorScheme.js";
    import Fa from "svelte-fa";
    import { faMoon, faSun } from "@fortawesome/free-solid-svg-icons";

    function toggle() {
        colorScheme.toggle();
    }
</script>

<button class="p-4 flex" on:click={toggle}>
    {#if $colorScheme === "light"}
        <Fa class="text-stone-500" icon={faMoon} size="lg" />
    {/if}

    {#if $colorScheme === "dark"}
        <Fa class="text-white" icon={faSun} size="lg" />
    {/if}
</button>
