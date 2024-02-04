<script>
    import Fa from "svelte-fa";

    export let icon;
    export let size;

    const defaultColors =
        "bg-neutral-100 text-neutral-500 dark:bg-neutral-700 dark:text-neutral-300 hover:text-neutral-600 dark:hover:text-neutral-200";

    size = size || "lg";
    let height = "p-1";
    let width = "w-12";
</script>

<span
    class="{height} {width} {defaultColors} rounded-full inline-flex justify-center {$$props.class}"
>
    <Fa {icon} {size} class={$$props.class} />
</span>
