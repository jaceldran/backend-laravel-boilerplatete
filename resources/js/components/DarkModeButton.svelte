<script>
    import { colorScheme } from "@/stores/colorScheme.js";
    import IconBadge from "@/components/ui/IconBadge.svelte";
    import { faMoon, faSun } from "@fortawesome/free-solid-svg-icons";

    function toggle() {
        colorScheme.toggle();
    }
</script>

<button class={$$props.class} on:click={toggle}>
    {#if $colorScheme === "light"}
        <IconBadge icon={faMoon} class="bg-transparent {$$props.class}" />
    {/if}

    {#if $colorScheme === "dark"}
        <IconBadge icon={faSun} class="dark:bg-transparent" />
    {/if}
</button>
