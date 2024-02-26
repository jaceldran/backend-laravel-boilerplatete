<script>
    import { createEventDispatcher } from "svelte";

    const dispatch = createEventDispatcher();

    const handleClick = (event) => {
        dispatch("click", {});
    };
</script>

<tr
    on:click={handleClick}
    class="border-inherit border-b
    hover:bg-neon-50
    dark:hover:bg-neon-900 {$$props.class || ''}"
>
    <slot />
</tr>
