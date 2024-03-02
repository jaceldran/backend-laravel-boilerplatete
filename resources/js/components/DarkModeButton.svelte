<script>
    import { colorScheme } from "@/stores/colorScheme.js";
    import Icon from "@/components/ui/Icon.svelte";
    // import Fa from "svelte-fa";
    // import IconBadge from "@/components/ui/IconBadge.svelte";
    import { faMoon, faSun } from "@fortawesome/free-solid-svg-icons";

    function toggle() {
        colorScheme.toggle();
    }
</script>

<button on:click={toggle} class="rounded-full px-1">
    {#if $colorScheme === "light"}
        <Icon icon={faMoon} size="lg" class={$$props.class} />
    {/if}

    {#if $colorScheme === "dark"}
        <Icon
            icon={faSun}
            size="lg"
            class="dark:bg-transparent {$$props.class}"
        />
    {/if}
</button>
