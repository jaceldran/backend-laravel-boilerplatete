<script>
    export let height;

    height = height || "h-10";
</script>

<section class="flex {height} my-2 {$$props.class}">
    <slot />
</section>
