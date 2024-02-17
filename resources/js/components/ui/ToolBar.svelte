<script>
    export let height;

    height = height || "py-4";
</script>

<section class="flex {height} {$$props.class}">
    <slot />
</section>
