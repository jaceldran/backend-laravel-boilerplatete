<script>
    import { createEventDispatcher } from "svelte";

    const dispatch = createEventDispatcher();

    const handleClick = (event) => {
        dispatch("click", {});
    };
</script>

<tr
    on:click={handleClick}
    class="border-inherit border-b dark:border-dark {$$props.class}"
>
    <slot />
</tr>
